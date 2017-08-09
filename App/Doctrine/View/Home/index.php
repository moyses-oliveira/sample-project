<?php

use Spell\MVC\Flash\Route;
use Spell\UI\HTML\Tag;

$action = $tables === false ? Route::getIndex() . 'home/index' : Route::getIndex() . 'home/build?' . http_build_query($_GET);
$method = $tables === false ?  'get':  'post';
echo <<<HTML
<form action="$action" method="$method">
HTML;

echo '<fieldset><legend style="padding: 5px 20px;">Entity</legend>';
if($tables === false):
echo <<<HTML
    <input name="prefix" placeholder="prefix_"/>
    <input name="nsp" placeholder="namespace\\namespace"/>
    <br/>
HTML;
else:
    foreach($tables as $res):
        $table = $res['tb'];
        $chk = Tag::mk('input')
            ->setAttr('type', 'checkbox')
            ->setAttr('name', 'entity[]')
            ->setAttr('value', $table);
        echo Tag::mk('div')->setContent($chk->render() . $table)->render();
    endforeach;
endif;
/*
  echo '</fieldset><fieldset><legend style="padding: 5px 20px;">Form</legend>';
  foreach($tables as $table)
  echo <<<HTML
  <input type="checkbox" name="form[]" value="{$table->tb}"/>{$table->tb}<br/>
  HTML;
  // * */
echo '</fieldset>';


echo <<<HTML
	<button type="submit">Build</button>
</form>

HTML;
