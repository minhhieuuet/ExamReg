<template>
	<div class="maintenance">
		<img src='/images/castleligo_s.jpg' alt='bitcastle'>
		<p class="maintenance-message">It is under maintenance now.</p>
		<p class="maintenance-text">We apologize for any inconvenience this may cause you.<br>
		Please wait for a while until maintenance is completed.</p>
	</div>
</template>

<style type="text/css" scoped>
  *{
    margin: 0;
    padding: 0;
    text-align: center;
  }
  html{
    height: 100%;
  }
  body{
    position: relative;
    height: 100%;
    font-family: "ヒラギノ角ゴ Pro W3", Hiragino Kaku Gothic Pro," メイリオ", Meiryo, Osaka," ＭＳ Ｐゴシック", MS PGothic," sans-serif";
    background: #eee;
  }
  .maintenance{
    position: absolute;
    left: 50%;
    top: 15%;
    margin-left: -300px;
    width: 600px;
    border: 2px solid #666;
    padding: 64px 32px;
    box-sizing: border-box;
    background: #fff;
    text-align: center;
  }
  .maintenance-message{
    font-size: 34px;
    margin-bottom: 24px;
    font-weight: bold;
  }
  .maintenance-date{
    color: #fff;
    padding: 8px;
    background: #cc0000;
    width: 90%;
    margin: 0 auto 16px;
  }
  img{
    width: 100px;
    height: 100px;
  }
</style>
