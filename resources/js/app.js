import Alpine from 'alpinejs';
import './bootstrap';

// Initialize Alpine.js
window.Alpine = Alpine

// Define global stores
document.addEventListener('alpine:init', () => {
    Alpine.store('modals', {
        openModals: new Set(),
        isOpen(modal) {
            return this.openModals.has(modal)
        },
        open(modal) {
            this.openModals.add(modal)
            document.body.style.overflow = 'hidden'
        },
        close(modal) {
            this.openModals.delete(modal)
            if (this.openModals.size === 0) {
                document.body.style.overflow = ''
            }
        },
        closeAll() {
            this.openModals.clear()
            document.body.style.overflow = ''
        }
    })
})

Alpine.start()
