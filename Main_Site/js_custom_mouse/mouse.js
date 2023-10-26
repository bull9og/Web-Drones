var mouseMove = document.querySelector('.mouse');
document.addEventListener('mousemove', (le) => {
  mouseMove.style.top=le.pageY + 'px'
  mouseMove.style.left=le.pageX + 'px'
});