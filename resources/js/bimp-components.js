// public/js/bimp-components.js
window.Bimp = {
    component: function(componentName, method, selector, data = {}) {
        fetch('/bimp-component', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                component: componentName,
                method: method,
                selector: selector,
                data: data
            })
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById(selector).innerHTML = html;
        });
    }
};