const pagination = document.querySelector('.pagination');
const prevBtn = pagination.querySelector('.prev');
const nextBtn = pagination.querySelector('.next');
const pageNumbers = pagination.querySelectorAll('button:not(.prev):not(.next)');

let currentPage = 1;

prevBtn.addEventListener('click', () => {
  currentPage--;
  if (currentPage < 1) {
    currentPage = pageNumbers.length; // Quay lại trang cuối cùng
  }
  updatePagination();
});

nextBtn.addEventListener('click', () => {
  currentPage++;
  if (currentPage > pageNumbers.length) {
    currentPage = 1; // Quay lại trang đầu tiên
  }
  updatePagination();
});

pageNumbers.forEach(button => {
  button.addEventListener('click', () => {
    currentPage = parseInt(button.textContent);
    updatePagination();
  });
});

function updatePagination() {
  pageNumbers.forEach(button => {
    button.classList.remove('active');
  });

  pageNumbers[currentPage - 1].classList.add('active');
}

