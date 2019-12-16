<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card data-background-color="green">
          <template slot="header">
            <md-icon >class</md-icon>
          </template>

          <template slot="content">
            <p class="category">Học phần</p>
              <h3 class="title">{{summary.total_module}}</h3>
          </template>

          <template slot="footer">
            <div class="stats">
                <!-- <md-icon>people</md-icon>
                Last 24 Hours -->
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card data-background-color="orange">
          <template slot="header">
            <md-icon >calendar_today</md-icon>
          </template>

          <template slot="content">
            <p class="category">Ca thi</p>
            <h3 class="title">{{summary.total_exam_session}}</h3>
          </template>

          <template slot="footer">
            <div class="stats">
              <!-- <md-icon class="text-danger">warning</md-icon>
              <a href="#pablo">Get More Space...</a> -->
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card data-background-color="red">
          <template  slot="header">
            <md-icon >people</md-icon>
          </template>

          <template slot="content">
            <p class="category">Sinh viên</p>
            <h3 class="title">{{summary.total_student}}</h3>
          </template>

          <template slot="footer">
            <div class="stats">
               <!-- <md-icon>local_offer</md-icon>
               Tracked from Github -->
            </div>
          </template>
        </stats-card>
      </div>
      <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <stats-card data-background-color="blue">
          <template  slot="header">
              <md-icon >meeting_room</md-icon>
          </template>

          <template slot="content">
            <p class="category">Phòng thi</p>
            <h3 class="title">{{summary.total_test_room}}</h3>
          </template>

          <template slot="footer">
            <div class="stats">
               <!-- <md-icon>update</md-icon>
               Just Updated -->
            </div>
          </template>
        </stats-card>
      </div>
      <!-- <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">
        <md-card>
          <md-card-header data-background-color="orange">
            <h4 class="title">Employees Stats</h4>
            <p class="category">New employees on 15th September, 2016</p>
          </md-card-header>
          <md-card-content>
            <ordered-table table-header-color="orange"></ordered-table>
          </md-card-content>
        </md-card>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">
        <nav-tabs-card>
          <template slot="content">
            <span class="md-nav-tabs-title">Tasks:</span>
            <md-tabs md-sync-route class="md-success" md-alignment="left">

              <md-tab id="tab-home" md-label="Bugs" md-icon="bug_report">
                <nav-tabs-table></nav-tabs-table>
              </md-tab>

              <md-tab id="tab-pages" md-label="Website" md-icon="code">
                <nav-tabs-table></nav-tabs-table>
              </md-tab>

              <md-tab id="tab-posts" md-label="server" md-icon="cloud">
                <nav-tabs-table></nav-tabs-table>
              </md-tab>
            </md-tabs>
          </template>
        </nav-tabs-card>
      </div> -->
    </div>
  </div>
</template>

<script>
import rf from '../../requests/RequestFactory';
import {
  StatsCard,
  ChartCard,
  NavTabsCard,
  NavTabsTable,
  OrderedTable
} from '@/components'

export default{
  components: {
    StatsCard,
    ChartCard,
    NavTabsCard,
    NavTabsTable,
    OrderedTable
  },
  data () {
    return {
      summary : {}
    }
  },
  created () {
    rf.getRequest('UserRequest').getSummaryReport().then(res => {
      this.summary = res;
    })
  }
}
</script>
