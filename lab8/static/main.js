function createPageBtn(page, classes=[]) {
    let btn = document.createElement('button');
    classes.push('btn');
    for (cls of classes) {
        btn.classList.add(cls);
    }
    btn.dataset.page = page;
    btn.innerHTML = page;
    return btn;
}

function renderPaginationElement(info) {
    let btn;
    let paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    btn = createPageBtn(1, ['first-page-btn']);
    btn.innerHTML = 'Первая страница';
    if (info.current_page == 1) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);

    let buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('pages-btns');
    paginationContainer.append(buttonsContainer);

    let start = Math.max(info.current_page - 2, 1);
    let end = Math.min(info.current_page + 2, info.total_pages);
    for (let i = start; i <= end; i++) {
        buttonsContainer.append(createPageBtn(i, i == info.current_page ? ['active'] : []));
    }

    btn = createPageBtn(info.total_pages, ['last-page-btn']);
    btn.innerHTML = 'Последняя страница';
    if (info.current_page == info.total_pages) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);
}

function perPageBtnHandler(event) {
    downloadData(1);
}

function setPaginationInfo(info) {
    document.querySelector('.total-count').innerHTML = info.total_count;
    let start = info.total_count > 0 ? (info.current_page - 1)*info.per_page + 1 : 0;
    document.querySelector('.current-interval-start').innerHTML = start;
    let end = Math.min(info.total_count, start + info.per_page - 1)
    document.querySelector('.current-interval-end').innerHTML = end;
}

function pageBtnHandler(event) {
    if (event.target.dataset.page) {
        downloadData(event.target.dataset.page);
        window.scrollTo(0, 0);
    }
}

function createAuthorElement(record) {
    let user = record.user || {'name': {'first': '', 'last': ''}};
    let authorElement = document.createElement('div');
    authorElement.classList.add('author-name');
    authorElement.innerHTML = user.name.first + ' ' + user.name.last;
    return authorElement;
}

function createUpvotesElement(record) {
    let upvotesElement = document.createElement('div');
    upvotesElement.classList.add('upvotes');
    upvotesElement.innerHTML = record.upvotes;
    return upvotesElement;
}

function createFooterElement(record) {
    let footerElement = document.createElement('div');
    footerElement.classList.add('item-footer');
    footerElement.append(createAuthorElement(record));
    footerElement.append(createUpvotesElement(record));
    return footerElement;
}

function createContentElement(record) {
    let contentElement = document.createElement('div');
    contentElement.classList.add('item-content');
    contentElement.innerHTML = record.text;
    return contentElement;
}

function createListItemElement(record) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('facts-list-item');
    itemElement.append(createContentElement(record));
    itemElement.append(createFooterElement(record));
    return itemElement;
}

function renderRecords(records) {
    let factsList = document.querySelector('.facts-list');
    factsList.innerHTML = '';
    for (let i = 0; i < records.length; i++) {
        factsList.append(createListItemElement(records[i]));
    }
}

function downloadData(page = 1) {
    let searchQuery = document.querySelector('.search-field').value;

    let factsList = document.querySelector('.facts-list');
    let url = new URL(factsList.dataset.url.replace('http://', 'https://'));
    let perPage = document.querySelector('.per-page-btn').value;
    url.searchParams.append('page', page);
    url.searchParams.append('per-page', perPage);
    url.searchParams.append('q', searchQuery);

    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderRecords(this.response.records);
        setPaginationInfo(this.response['_pagination']);
        renderPaginationElement(this.response['_pagination']);
    }
    xhr.send();
}

function searchRecords() {
    let searchInput = document.querySelector('.search-field');
    let searchQuery = searchInput.value.trim();
    downloadData(searchQuery);
}

function handleSearchInput() {
    const searchInput = document.querySelector('.search-field');
    const query = searchInput.value.trim();

    if (query.length > 0) {
        // Отправить запрос на автодополнение
        fetch(`http://cat-facts-api.std-900.ist.mospolytech.ru/autocomplete?q=${query}`)
            .then(response => response.json())
            .then(data => {
                // Отобразить рекомендации в выпадающем списке
                const autoCompleteList = document.querySelector('.autocomplete-list');
                autoCompleteList.innerHTML = '';

                data.forEach(recommendation => {
                    const item = document.createElement('div');
                    item.classList.add('autocomplete-item');
                    item.textContent = recommendation;

                    // Добавить обработчик клика для выбора рекомендации
                    item.addEventListener('click', () => {
                        searchInput.value = recommendation;
                        autoCompleteList.innerHTML = ''; // Скрыть список рекомендаций
                    });

                    autoCompleteList.appendChild(item);
                });
            })
            .catch(error => {
                console.error('Ошибка при выполнении запроса автодополнения:', error);
            });
    } else {
        const autoCompleteList = document.querySelector('.autocomplete-list');
        autoCompleteList.innerHTML = '';
    }
}

window.onload = function () {
    downloadData();

    document.querySelector('.pagination').onclick = pageBtnHandler;
    document.querySelector('.per-page-btn').onchange = perPageBtnHandler;
    document.querySelector('.search-btn').addEventListener('click', searchRecords); 
    document.querySelector('.search-field').addEventListener('input', handleSearchInput);
}
