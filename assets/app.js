import React from 'react';
import {createRoot} from 'react-dom/client';
import './styles/app.css';
import Sidebar from './partials/sidebar.js';
import Navbar from './partials/navbar.js';
import Footer from "./partials/footer.js";


$(document).ready(function () {
    $.ajax({
        url: '/uiAjax',
        method: 'POST',
        success: function (response) {
            const sidebarElement = document.querySelector('.sidebar');
            const navbarElement = document.querySelector('.navbar');
            const footerElement = document.querySelector('.footer');
            if (sidebarElement) {
                const sidebarRoot = createRoot(sidebarElement);
                sidebarRoot.render(
                    <Sidebar dataSet={response.sidebar}/>
                );
            }
            if (navbarElement) {
                const navbarRoot = createRoot(navbarElement);
                navbarRoot.render(
                    <Navbar dataSet={response.navbar}/>
                );
            }
            if (footerElement) {
                const footerRoot = createRoot(footerElement);
                footerRoot.render(
                    <Footer/>
                );
            }
        },
        error: function (xhr) {
            console.log("Error: Status: " + xhr.status);
        }
    });
});



