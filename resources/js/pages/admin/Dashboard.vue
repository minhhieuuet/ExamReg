<template>
  <div class="dash">
    <h1 class="md-display-3">Dashboard</h1>
    <div>
  <md-card>
    <md-card-header>
      <md-card-header-text>
        <div class="md-title">Media card</div>
        <div class="md-subhead">Normal size</div>
      </md-card-header-text>

      <md-card-media>
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>
    </md-card-header>

    <md-card-actions>
      <md-button>Action</md-button>
      <md-button>Action</md-button>
    </md-card-actions>
  </md-card>

  <md-card>
    <md-card-header>
      <md-card-header-text>
        <div class="md-title">Media card</div>
        <div class="md-subhead">Medium size</div>
      </md-card-header-text>

      <md-card-media md-medium>
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>
    </md-card-header>

    <md-card-actions>
      <md-button>Action</md-button>
      <md-button>Action</md-button>
    </md-card-actions>
  </md-card>

  <md-card>
    <md-card-header>
      <md-card-header-text>
        <div class="md-title">Media card</div>
        <div class="md-subhead">Big size</div>
      </md-card-header-text>

      <md-card-media md-big>
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>
    </md-card-header>

    <md-card-actions>
      <md-button>Action</md-button>
      <md-button>Action</md-button>
    </md-card-actions>
  </md-card>

  <md-card>
    <md-card-media-actions>
      <md-card-media>
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>

      <md-card-actions>
        <md-button class="md-icon-button">
          <md-icon>favorite</md-icon>
        </md-button>

        <md-button class="md-icon-button">
          <md-icon>bookmark</md-icon>
        </md-button>

        <md-button class="md-icon-button">
          <md-icon>share</md-icon>
        </md-button>
      </md-card-actions>
    </md-card-media-actions>
  </md-card>
</div>
<div>
  <md-card>
    <md-card-media-cover>
      <md-card-media md-ratio="16:9">
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>

      <md-card-area>
        <md-card-header>
          <span class="md-title">Without text background</span>
          <span class="md-subhead">I bet you can't read this</span>
        </md-card-header>

        <md-card-actions>
          <md-button>Neither this</md-button>
          <md-button>Or this</md-button>
        </md-card-actions>
      </md-card-area>
    </md-card-media-cover>
  </md-card>

  <md-card>
    <md-card-media-cover md-text-scrim>
      <md-card-media md-ratio="16:9">
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>

      <md-card-area>
        <md-card-header>
          <span class="md-title">Gradient background</span>
          <span class="md-subhead">16/9 image</span>
        </md-card-header>

        <md-card-actions>
          <md-button>Action</md-button>
          <md-button>Action</md-button>
        </md-card-actions>
      </md-card-area>
    </md-card-media-cover>
  </md-card>

  <md-card>
    <md-card-media-cover md-solid>
      <md-card-media md-ratio="4:3">
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>

      <md-card-area>
        <md-card-header>
          <span class="md-title">Solid background</span>
          <span class="md-subhead">4/3 image</span>
        </md-card-header>
      </md-card-area>
    </md-card-media-cover>
  </md-card>

  <md-card>
    <md-card-media-cover md-solid>
      <md-card-media md-ratio="1:1">
        <img src="/sample.jpeg" alt="Cover">
      </md-card-media>

      <md-card-area>
        <md-card-header>
          <span class="md-title">Solid background</span>
          <span class="md-subhead">1/1 image</span>
        </md-card-header>

        <md-card-actions>
          <md-button class="md-icon-button">
            <md-icon>favorite</md-icon>
          </md-button>

          <md-button class="md-icon-button">
            <md-icon>share</md-icon>
          </md-button>
        </md-card-actions>
      </md-card-area>
    </md-card-media-cover>
  </md-card>
</div>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data () {
    return {
      msg: 'Atom_Vue'
    }
  }
}
</script>

<style lang="scss" scoped >
.md-card {
  width: 320px;
  margin: 4px;
  display: inline-block;
  vertical-align: top;
  }
</style>
