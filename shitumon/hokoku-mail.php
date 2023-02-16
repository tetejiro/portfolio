<?php
//  mail
    $honbun='';
    $honbun.=$member_codename."さんから、\n";
    $honbun.=$name."さん宛てに報告・連絡が入りました。\n";
    $honbun.='返事は'.$_SESSION['return'].'だそうです。';
    $honbun.="内容は以下の通りです。\n";
    $honbun.="\n\n";
    $honbun.="----------------------------\n";
    $honbun.="〇件名\n";
    $honbun.=$purpose."\n\n";
    $honbun.="〇詳細\n";
    $honbun.=$title."\n\n";
    $honbun.="〇その他\n";
    $honbun.=$try."\n\n";
    $honbun.="----------------------------\n\n";
    $honbun.="お手すきの際に、対応していただけますと幸いです。\n\n";
    $honbun.="※このメールは送信専用です。返信はできません。";

    $title='報告・連絡のお知らせです。※返答　'.$_SESSION['return'];
    $header='From:info@snowy-hita-3070.cheap.jp';
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($mail,$title,$honbun,$header);

?>
