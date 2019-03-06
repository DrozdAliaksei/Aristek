const orderFields = document.getElementsByClassName('order-field');
const filterDirectionElem = document.querySelector('.filter-direction');
const filterFieldElem = document.querySelector('.filter-field');
const limitElem = document.querySelector('.page-limit');
const offsetElem = document.querySelector('.page-offset');
const form = document.getElementsByTagName('form')[0];

function clear() {
  for (let i = 0; i < orderFields.length; i++) {
    orderFields[i].classList.remove('asc');
    orderFields[i].classList.remove('desc');
  }
}

for (i = 0; i < orderFields.length; i++) {
  orderFields[i].addEventListener('click', () => {
    const current = event.target;
    if (filterDirectionElem.value === 'asc') {
      filterDirectionElem.value = 'desc';
    } else {
      filterDirectionElem.value = 'asc';
    }

    filterFieldElem.value = current.dataset.field;
    form.submit();
  });
}

limitElem.addEventListener('change', () => form.submit());

let current_page = parseInt(document.querySelector('.current-page').dataset.value, 10);
let count_pages = parseInt(document.querySelector('.count-pages').dataset.value, 10);

document.querySelector('.pagination-prev')
  .addEventListener('click', () => {
    if (current_page.value > 1) {
      current_page -= 1;
      offsetElem.value -= limitElem.value;
    }
  });

document.querySelector('.pagination-next')
  .addEventListener('click', () => {
    if (current_page < count_pages) {
      current_page += 1;
      offsetElem.value += parseInt(limitElem.value, 10);
    }
  });

document.getElementsByClassName('apply')[0]
  .addEventListener('click', () => {
    current_page = 1;
    offsetElem.value = 0;
  });
document.querySelector('.reset')
  .addEventListener('click', () => {
    filterDirectionElem.value = 'asc';
    filterFieldElem.value = 'login';
    offsetElem.value = 0;
    limitElem.value = 5;
    form.submit();
  });

//TODO http://smart-home.lh/users?filter[login]=2341&filter[role]=admin&order_by=&order_dir=asc&limit=5&offset=0