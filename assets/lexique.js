import './styles/lexique.scss';

document.getElementById('tab-mot').addEventListener('click', () => {
    document.getElementById('table-mots').style.display = 'table';
    document.getElementById('table-expressions').style.display = 'none';
});

document.getElementById('tab-expression').addEventListener('click', () => {
    document.getElementById('table-expressions').style.display = 'table';
    document.getElementById('table-mots').style.display = 'none';
});