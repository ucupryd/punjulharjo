import './bootstrap';

import StickySidebar from 'sticky-sidebar';

document.addEventListener('DOMContentLoaded', () => {
    if (!document.querySelector('.promo-wrapper')) return;
    new StickySidebar('.promo-wrapper', {
        topSpacing: 100,               // jarak dari navbar
        bottomSpacing: 32,             // jarak dari dasar viewport
        containerSelector: '.berita-grid',
        innerWrapperSelector: '.promo-inner',
        minWidth: 1024,                // sticky hanya aktif di desktop (lg+)
    });
});
