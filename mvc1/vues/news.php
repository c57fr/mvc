<h1>Les news du site </h1>

<?php

foreach ($news as $n) {
 echo '
  <div class="news">
  <h2>' . $n['titre'] . '</h2>
  <p>News postée le ' . str_replace(' ', ' à ', $n['date_formatee']) . ' par ' . $n['auteur'] . '</p>
  <p>' . $n['contenu'] . '</p>
  </div>';
}
