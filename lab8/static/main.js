/*Создает кнопку пагинации с указанным номером страницы и классами.*/
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

/*Отображает элементы пагинации на основе переданных данных.*/
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

/*Обрабатывает событие изменения количества записей на странице.
Вызывает функцию downloadData с номером страницы 1 для загрузки данных с новыми настройками.*/
function perPageBtnHandler(event) {
    downloadData(1);
}

/*Устанавливает информацию о текущей странице, количестве записей и интервале на странице.*/
function setPaginationInfo(info) {
    document.querySelector('.total-count').innerHTML = info.total_count;
    let start = info.total_count > 0 ? (info.current_page - 1)*info.per_page + 1 : 0;
    document.querySelector('.current-interval-start').innerHTML = start;
    let end = Math.min(info.total_count, start + info.per_page - 1)
    document.querySelector('.current-interval-end').innerHTML = end;
}

/*Обрабатывает событие нажатия на кнопку пагинации.
Вызывает функцию downloadData с номером страницы, соответствующим нажатой кнопке, и перемещается вверх страницы.*/
function pageBtnHandler(event) {
    if (event.target.dataset.page) {
        downloadData(event.target.dataset.page);
        window.scrollTo(0, 0);
    }
}

/*Создает и возвращает HTML-элемент для отображения имени автора на основе переданной записи.*/
function createAuthorElement(record) {
    let user = record.user || {'name': {'first': '', 'last': ''}};
    let authorElement = document.createElement('div');
    authorElement.classList.add('author-name');
    authorElement.innerHTML = user.name.first + ' ' + user.name.last;
    return authorElement;
}

/*Создает и возвращает HTML-элемент для отображения количества голосов "за" на основе переданной записи.*/
function createUpvotesElement(record) {
    let upvotesElement = document.createElement('div');
    upvotesElement.classList.add('upvotes');
    upvotesElement.innerHTML = record.upvotes;
    return upvotesElement;
}

/*Создает и возвращает HTML-элемент, представляющий подвал элемента списка фактов, содержащий информацию об авторе и количестве голосов.*/
function createFooterElement(record) {
    let footerElement = document.createElement('div');
    footerElement.classList.add('item-footer');
    footerElement.append(createAuthorElement(record));
    footerElement.append(createUpvotesElement(record));
    return footerElement;
}

/*Создает и возвращает HTML-элемент, представляющий содержание элемента списка фактов, содержащий текст факта.*/
function createContentElement(record) {
    let contentElement = document.createElement('div');
    contentElement.classList.add('item-content');
    contentElement.innerHTML = record.text;
    return contentElement;
}

/*Создает и возвращает HTML-элемент, представляющий элемент списка фактов, включая контент и подвал.*/
function createListItemElement(record) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('facts-list-item');
    itemElement.append(createContentElement(record));
    itemElement.append(createFooterElement(record));
    return itemElement;
}

/*Отображает список записей, очищая текущий контент в списке фактов и добавляя новые элементы списка для каждой записи.*/
function renderRecords(records) {
    let factsList = document.querySelector('.facts-list');
    factsList.innerHTML = '';
    for (let i = 0; i < records.length; i++) {
        factsList.append(createListItemElement(records[i]));
    }
}

/*Загружает данные с сервера на основе указанной страницы, текущего поискового запроса и количества записей на странице.
Вызывает функции для отображения полученных записей, обновления информации о пагинации и отображения кнопок пагинации.*/
function downloadData(page = 1) {
    let searchQuery = document.querySelector('.search-field').value;

    let factsList = document.querySelector('.facts-list');
    let url = new URL(factsList.dataset.url);
    /*let url = new URL(factsList.dataset.url.replace('http://', 'https://'));*/

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

/*Инициирует поиск записей на основе текущего введенного запроса поиска.*/
function searchRecords() {
    let searchInput = document.querySelector('.search-field');
    let searchQuery = searchInput.value.trim();
    downloadData(searchQuery);
}

/*Обрабатывает ввод в поле поиска, отправляя запрос на автодополнение на основе введенного запроса.
Отображает рекомендации автодополнения и устанавливает обработчики клика для выбора рекомендаций.*/
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

/*Привязывает обработчики событий к различным элементам после загрузки окна.
Вызывает функцию downloadData для начальной загрузки данных.
Устанавливает обработчики событий для кнопок пагинации, изменения количества записей на странице, 
клика по кнопке поиска и изменения ввода поиска.*/
window.onload = function () {
    downloadData();

    document.querySelector('.pagination').onclick = pageBtnHandler;
    document.querySelector('.per-page-btn').onchange = perPageBtnHandler;
    document.querySelector('.search-btn').addEventListener('click', searchRecords); 
    document.querySelector('.search-field').addEventListener('input', handleSearchInput);
}
