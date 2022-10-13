"use strict";
 
const collapseMenu = () => {
    let currentUrl = document.querySelector('#locationpath').innerHTML;
    let button = document.querySelector('.menu-link[href$="'+currentUrl+'"]');
    let submenu = button.parentElement.parentElement;
    let menu = button.parentElement.parentElement.parentElement;
    let toolbar = document.querySelector('.page-title');
    let text;
    if (submenu.classList.contains('menu-sub')) {
        text = `<h1 id="toolbar-id" class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">${button.innerText}</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">${menu.innerText}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">${button.innerText}</li>
                </ul>`;
        menu.classList.add('here');
        menu.classList.add('show');
        submenu.classList.add('menu-active-bg');
        button.classList.add('active');
        toolbar.innerHTML = text;
    } else {
        text = `<h1 id="toolbar-id" class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">${button.innerText}</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">${button.innerText}</li>
                </ul>`;
        button.classList.add('active');
        toolbar.innerHTML = text;
    }
}


KTUtil.onDOMContentLoaded( () => {
    collapseMenu();
});