import './styles/lexique.scss';

const btnMot = document.getElementById('tab-mot');
const btnExpression = document.getElementById('tab-expression');
const tableMots = document.getElementById('table-mots');
const tableExpressions = document.getElementById('table-expressions');

if (btnMot && tableMots && tableExpressions) {
    btnMot.addEventListener('click', () => {
        tableMots.style.display = 'table';
        tableExpressions.style.display = 'none';
    });
}

if (btnExpression && tableExpressions && tableMots) {
    btnExpression.addEventListener('click', () => {
        tableExpressions.style.display = 'table';
        tableMots.style.display = 'none';
    });
}