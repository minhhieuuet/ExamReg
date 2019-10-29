<template>
  <div class="not-found-page">
      <h1 align="center">404 Not Found</h1>
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
