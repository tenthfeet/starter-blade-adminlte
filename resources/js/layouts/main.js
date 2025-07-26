import Layout from "admin-lte/src/ts/layout";
import PushMenu from "admin-lte/src/ts/push-menu";
import Treeview from "admin-lte/src/ts/treeview";
import CardWidget from "admin-lte/src/ts/card-widget";
import Dropdown from 'bootstrap/js/dist/dropdown';

const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';

const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
};

document.addEventListener('DOMContentLoaded', setupSidebar);

function setupSidebar() {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

    if (!sidebarWrapper) return;

    if (typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
            },
        });
    }

    const link = $(sidebarWrapper).find(`.nav-link[href="${location.href}"]`);
    link.addClass('active');
    link.closest(".nav-treeview").parent().addClass("menu-open");
    link.closest(".nav-treeview").prev().addClass("active");
}
