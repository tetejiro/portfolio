<?php

class Common{
  public function printHead($cssContent) {
    $css = $cssContent;

    print '<!DOCTYPE html>';
    print '<html lang="ja">';

    print '<head>';
    print '  <meta charset="utf-8">';
    print '  <title>しつもん</title>';
    print '  <meta name="viewport" content="width=device-width,initial-scale=1">';

    // css
    print '  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">';
    print '  <link rel="stylesheet" href='. $css . '>';
    print '  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">';
    print '  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">';
    print '</head>';
  }
}