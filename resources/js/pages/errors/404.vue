<template>
  <div class="not-found-page">
    <div class="page1920 container">
      <div class="not-found-content">
        <div class="content-wrapper">
          <div class="not-found-icon">
            <span class="iconmo-404"><span class="path1"/><span class="path2"/><span class="path3"/><span class="path4"/><span class="path5"/><span class="path6"/><span class="path7"/><span class="path8"/><span class="path9"/><span class="path10"/><span class="path11"/><span class="path12"/><span class="path13"/><span class="path14"/><span class="path15"/><span class="path16"/><span class="path17"/><span class="path18"/></span>
          </div>

          <div class="not-found-textbox">
            <h3 class="title">404</h3>
            <article class="description" />

              <h1>404 error</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .not-found-page {
    .container {
      padding: 0;
    }

    .not-found-content {
      background-color: #fff;
      position: relative;
      overflow: hidden;
    }

    .content-wrapper {
      min-width: 600px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .not-found-icon {
      display: inline-block;
      margin-right: 60px;
      vertical-align: bottom;
      opacity: 0.5;

      .iconmo-404 {
        font-size: 160px;
      }
    }

    .not-found-textbox {
      display: inline-block;
      max-width: 370px;
      text-align: left;

      .title {
        font-size: 25px;
        color: #1ea1f2;
        margin: 0 0 10px;
        font-weight: normal;
      }

      .description {
        font-size: 14px;
        color: #666666;
        margin-bottom: 24px;
      }

      .button-01 {
        display: inline-block;
        background-color: #1ea1f2;
        color: #fff;
        border-radius: 5px;
        font-size: 14px;
        line-height: 1;
        padding: 12px 28px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;

        &:hover {
          background-color: #0f8ddb;
        }
      }
    }
  }
</style>
