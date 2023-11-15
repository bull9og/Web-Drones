// Получаем ссылку на элемент формы входа
const loginForm = document.getElementById('login-form');

// Функция для проверки, авторизирован ли пользователь
function checkAuthorization() {
  // Отправляем асинхронный запрос на сервер для проверки статуса авторизации пользователя
  fetch('signin.php', {
    method: 'GET',
    credentials: 'include' // Отправляем куки на сервер, чтобы сервер мог проверить авторизацию пользователя
  })
    .then(response => response.json())
    .then(data => {
      if (data.userLoggedIn) {
        // Пользователь вошел в систему или зарегистрирован

        // Скрываем форму входа
        loginForm.style.display = 'none';
      } else {
        // Пользователь не вошел в систему и не зарегистрирован

        // Показываем форму входа
        loginForm.style.display = 'flex';
      }
    });
}

// Вызываем функцию для проверки авторизации пользователя при загрузке страницы
checkAuthorization();