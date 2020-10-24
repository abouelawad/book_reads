<h1>hello from posts / index</h1>

<!-- <?php foreach ($posts as $post) {
        echo  "<p>" . $post['id'] . " :  </p>";
        echo $post['title'];
        echo '<br />';
      }
      ?> 
-->



  <?php foreach ($posts as $post) : ?>
 <p> <?= $post['id'] ?></p>
 <p> <?= $post['title'] ?></p>
  <p> <?= '<br />' ?> </p> 
<?php endforeach; ?>  
