class Alert {
    constructor(message) {
        this.message = message;
        this.alertElement = this.createAlertElement();
    }

    createAlertElement() {
        const alert = document.createElement('div');
        alert.classList.add('alert');
        alert.textContent = this.message;

        document.body.appendChild(alert);
        return alert;
    }

    show() {
        this.alertElement.style.display = 'block';
        setTimeout(() => {
            this.hide();
        }, 3000); // Alerta desaparece após 3 segundos
    }

    hide() {
        this.alertElement.style.display = 'none';
        this.remove();
    }

    remove() {
        if (this.alertElement) {
            document.body.removeChild(this.alertElement);
            this.alertElement = null;
        }
    }
}

const showAlert = (message) => {
    const alert = new Alert(message);
    alert.show();
};

window.showAlert = showAlert
