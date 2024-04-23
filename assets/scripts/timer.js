let timerInterval;

function showModal() {
  document.getElementById('modal-con').style.display = 'block';
}

function hideModal() {
  document.getElementById('modal-con').style.display = 'none';
}


// Добавляем класс "hide", чтобы скрыть форму
document.querySelector('.bubbly-button').addEventListener('click', function() {
  const button = document.querySelector('.bubbly-button');
  
  if (button.dataset.state === 'start') {
    // Изменяем состояние кнопки на "Stop Timer"
    button.textContent = 'Stop Timer';
    button.dataset.state = 'stop';
    
    // Показываем форму, текст и запускаем таймер
    document.getElementById('formContainer').style.display = 'block';
    document.getElementById('secondText').style.display = 'block';
    document.getElementById('timer').style.display = 'block';
    
    // Генерируем рандомное количество времени
    const minTime = 45 * 60 * 1000; // 45 минут
    const maxTime = 120 * 60 * 1000; // 2 часа
    const randomTime = Math.floor(Math.random() * (maxTime - minTime + 1)) + minTime;

    // Запоминаем время начала для подсчета оставшегося времени
    const startTime = new Date();

    // Устанавливаем интервал для обновления таймера каждую секунду
    timerInterval = setInterval(function() {
      const now = new Date();
      const remainingTime = randomTime - (now - startTime);
      
      // Если время истекло, останавливаем таймер
      if (remainingTime <= 0) {
        clearInterval(timerInterval);
        showModal();
        button.textContent = 'Start Timer';
        document.getElementById('timer').style.display = 'none';
        document.getElementById('formContainer').style.display = 'none';
        document.getElementById('secondText').style.display = 'none';
        document.getElementById('timer-data-sub').style.display = 'block';
        document.getElementById('timer-submit').disabled = true;
      } else {
        // Форматируем и выводим оставшееся время
        const minutes = Math.floor(remainingTime / 60000);
        const seconds = Math.floor((remainingTime % 60000) / 1000);
        document.getElementById('timer_data').value = parseInt(randomTime / 60000);
        document.getElementById('timerDisplay').textContent = `Time left: ${minutes} min ${seconds} sec`;
      }
    }, 1000);
  } else {
    // Останавливаем таймер и скрываем все элементы
    clearInterval(timerInterval);
    document.getElementById('timer').style.display = 'none';
    document.getElementById('formContainer').style.display = 'none';
    document.getElementById('secondText').style.display = 'none';
    
    // Изменяем состояние кнопки на "Start Timer"
    button.textContent = 'Start Timer';
    button.dataset.state = 'start';
  }
});
