<template>
  <div class="content">
    <div class="md-right" style="float: right;">
        <md-button @click="print" class="md-success">
          <md-icon>print</md-icon> In kết quả
        </md-button>
    </div>
    <div class="print-area" id="printMe" style="background-color: white;font-family: 'Times New Roman', Arial;  padding: 20px;">
        <table style="width: 100%; border: none; border-collapse: collapse;">
            <tbody><tr>
                <td style="width: 40%; text-align: center; vertical-align: top;">
                    <p style="text-transform: uppercase; font-weight: normal; margin: 0; padding: 0; font-size: 12pt;">ĐẠI HỌC QUỐC GIA HÀ NỘI</p>
                </td>
                <td style="width: 60%; text-align: center; vertical-align: top;">
                    <p style="text-transform: uppercase; font-weight: bold; margin: 0; padding: 0; font-size: 12pt;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                    <p style="margin: 0; padding: 0; font-weight: bold;">Độc lập - Tự do - Hạnh phúc</p>
                </td>
            </tr>
        </tbody></table>
        <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-size: 14pt; margin: 30px 0 0 0; padding: 0;">
          KẾT QUẢ ĐĂNG KÝ THI - HỌC KỲ 1 NĂM HỌC 2019-2020
        </h1>
        <p style="text-align: center; font-weight: bold; margin: 0; padding: 0; font-size: 14pt;">
            Ngày {{time.format('D')}} tháng {{time.format('MM')}} năm {{time.format('YYYY')}}
        </p>
        <table style="width: 100%; border: none; border-collapse: collapse; margin-top: 30px;">
            <tbody>
              <tr>
                <td>Họ và tên</td>
                <td><b>{{user.full_name}}</b></td>
                <td>Mã sinh viên</td>
                <td><b>{{user.name}}</b></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><b>{{user.email}}</b></td>
            </tr>
        </tbody></table>
        <br>
        <table style="border:none; width: 100%; border-collapse:collapse;">

            <tbody><tr>
                <th style="border-top:1px solid #000; border-left:1px solid #000; text-align:center;">STT</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Mã học phần</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Học phần</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Ngày thi</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Bắt đầu</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Kết thúc</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;">Phòng thi</th>
                <th style="border-top: 1px solid #000; border-left: 1px solid #000; border-right:1px solid #000; text-align: center;">Điểm thi</th>
            </tr>
        <tr v-for="(item, index) in registedSessions">
            <td style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;border-bottom: 1px solid #000;">{{index+1}}</td>
            <td style="border-top:1px solid #000; border-left:1px solid #000;border-bottom: 1px solid #000;">&nbsp;{{item.module_code}}</td>
            <td style="border-top:1px solid #000; border-left:1px solid #000;border-bottom: 1px solid #000;">&nbsp;{{item.module_name}}</td>
            <td style="border-top: 1px solid #000; border-left: 1px solid #000; text-align: center;border-bottom: 1px solid #000;">{{item.started_at | toDateFormat}}</td>
            <td style="border-top:1px solid #000; border-left:1px solid #000;text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;">&nbsp;{{item.started_at | toTimeFormat}}</td>
            <td style="border-top:1px solid #000; border-left:1px solid #000; text-align:center;border-top: 1px solid #000;border-bottom: 1px solid #000;">&nbsp;{{item.finished_at | toTimeFormat}}</td>
            <td style="border-top:1px solid #000; border-left:1px solid #000;border-top: 1px solid #000;border-bottom: 1px solid #000;">&nbsp;{{item.test_room_name}} - <b>{{item.room_name}}</b></td>
            <td style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;border-top: 1px solid #000;border-bottom: 1px solid #000; text-align: center;">{{item.test_site_name  }}</td>
        </tr>
        </tbody></table>

        <p style="font-size: 12pt; margin-top:15px;">Tổng số ca thi đã đăng ký: {{registedSessions.length}} (ca thi)</p>
        <table style="width: 100%; border: none; border-collapse: collapse; margin-top: 30px;">
            <tbody><tr>
                <td style="width: 50%; vertical-align: top; text-align: center;">
                    <p style="font-weight: bold; margin: 0; padding: 0; font-size: 12pt; text-transform:uppercase;">SINH VIÊN</p>
                    <p style="margin: 0; padding: 0; font-size: 11pt; font-style: italic;">(Ký và ghi rõ họ tên)</p>
                    <p style="margin-top:80px;"><b>{{user.full_name}}</b></p>
                </td>
                <td style="width: 50%; text-align: center; vertical-align: top; ">
                    <p style="font-size: 12pt; margin:0; padding:0;">Hà Nội, ngày ..... tháng ..... năm 2019</p>
                    <p style="font-weight: bold; margin: 0; padding: 0; text-transform: uppercase; font-size: 12pt;">XÁC NHẬN CỦA PHÒNG ĐÀO TẠO</p>
                    <p style="font-weight: bold; margin-top: 80px;">&nbsp;</p>
                </td>
            </tr>
        </tbody></table>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import rf from '../../requests/RequestFactory';
export default{
  data () {
    return {
      time: moment(),
      user:{},
      registedSessions: []
    }
  },
  methods: {
    getAllRegistedSessions () {
      rf.getRequest('UserRequest').getAllRegistedSessionsWithoutPagination().then(res => {
        this.registedSessions = res;
      })
    },
    print () {
      this.$htmlToPaper('printMe');
    }
  },
  created: function () {
    rf.getRequest('UserRequest').getCurrentUser().then(res => {
      this.user = res;
    });
    this.getAllRegistedSessions();
  }
}
</script>
<style lang="css">

</style>
