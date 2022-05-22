<section class="form-section">
  <div class="form-section__image">
    <img src="./images/welcome.jpg" alt="image welcome" class="image-welcome"/>
  </div>
  <p class="form-section__text">Записаться на курс</p>
  <form method="POST" action="form-handl.php" enctype="x-www-formd-data" class="form-section__form">
    <input required type="text" name="username" placeholder="Ваше имя" class="form__input">
    <input required type="email" name="email" placeholder="Email" class="form__input">
    <select id="form__select-id" class="form__input form__select" name="profession">
      <option selected disabled hidden value="">Деятельность</option>
      <option value="programmer">Программист</option>
      <option value="designer">Дизайнер</option>
      <option value="marketer">Маркетолог</option>
    </select>
    <div class="form__checkbox-block">
      <input type="checkbox" name="checkbox-agree" id="checkbox-agree" class="form__checkbox-button">
      <label for="checkbox-agree" class="form__checkbox-text">Согласен получать информационные материалы о старте курса</label>
    </div>
    <input type="submit" value="Записаться на курс" class="form__input form__button">
  </form>
</section>