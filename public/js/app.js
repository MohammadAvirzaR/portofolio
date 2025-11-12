// app.js

document.addEventListener('DOMContentLoaded', () => {
    console.log('Document is ready!');

    const button = document.getElementById('myButton');
    button.addEventListener('click', () => {
        alert('Button was clicked!');
    });

    const changeColor = (element) => {
        element.style.backgroundColor = 'lightblue';
    };

    const elements = document.querySelectorAll('.color-change');
    elements.forEach(element => {
        element.addEventListener('mouseover', () => changeColor(element));
    });
});
