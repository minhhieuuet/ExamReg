<template >
  <div>
    <h1>Login Page</h1>
    <div class="" style="text-align:center">
      <input
      id="email"
                ref="email"
                v-model="email"
       type="text" name="" value="" >
      <br>
      <input type="password" id="password"
                  ref="password"
                  v-model="password" name="" value="">
      <br>
      <button type="button" name="button"  @click="submit()">Login</button>
    </div>
  </div>
</template>

<script>
import rf from '../requests/RequestFactory';
import AuthenticationUtils from '../common/AuthenticationUtils';

export default {
    name: 'LoginPage',
    data () {
      return {
        securityUrl: process.env.MIX_SECURITY_APP_URL,
        email: '',
        password: '',
        isLoading: false,
      };
    },
    mounted () {
      this.email = this.$route.query.email;
    },
    methods: {
      submit () {
          const params = {
            email: this.email,
            password: this.password,
          };
          this.login(params);
      },
      login (params) {
        return rf.getRequest('UserRequest').login(params).then(async (response) => {
          await AuthenticationUtils.login(response);
          this.$router.push({ path: '/' });
        }).catch(async (error) => {
          console.log(error);
        }).finally(() => {
          this.isLoading = false;
        });
      },
    },
  };
</script>

<style lang="css" scoped >
  h1 {
    text-align: center;
  }
</style>
