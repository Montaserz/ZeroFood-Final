<template>
  <v-row>
    <v-col cols="12" style="padding: 0px;">
      <v-card class=" mx-auto">
        <v-row justify="space-between" align="center">
          <v-col
            xs="12"
            md="8"
            class="text-center pl-0"
            style="padding: 0px !important;"
          >
            <v-img
              src="https://cdn.dribbble.com/users/1355613/screenshots/6807438/food_delivery_2x.jpg"
            />
          </v-col>
          <v-col xs="12" md="4" class="px-4">
            <h1 class="title pb-4 px-4">Login to your account 🔒</h1>
            <p
              class="white--text text-center py-2 px-4"
              :style="`background-color:#00b894 !important;`"
              v-if="validationMsg != ''"
            >
              {{ validationMsg }}
            </p>
            <v-card-text class="pt-4">
              <div>
                <v-form ref="form">
                  <v-text-field
                    label="Enter your email"
                    v-model="email"
                    required
                  ></v-text-field>
                  <v-text-field
                    label="Enter your password"
                    v-model="password"
                    type="password"
                    counter
                    required
                  ></v-text-field>
                  <v-layout>
                    <v-btn
                      @click="login"
                      class="white--text w-100"
                      :style="`background-color:#00b894 !important;`"
                      >Login</v-btn
                    >
                  </v-layout>
                </v-form>
              </div>
            </v-card-text>
            <p class="text-center">
              Don't have one ?
              <router-link to="/registration" style="color: #00b894 !important;"
                >Create one</router-link
              >
            </p>
            <p class="text-center">
              Keep going as
              <router-link to="/" style="color: #00b894 !important;"
                >Gust</router-link
              >
            </p>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      validationMsg: ''
    }
  },
  methods: {
    login() {
      this.$store.dispatch('destroyToken')
      let emailVaild = /\S+@\S+\.\S+/
      if (!this.email) return (this.validationMsg = 'Email is Required ✉️')
      if (!emailVaild.test(this.email))
        return (this.validationMsg = 'Email must be vaild ✉️')
      if (!this.password)
        return (this.validationMsg = 'Password is Required 👩‍💻')
      this.validationMsg = ''
      this.$store
        .dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(async response => {
          if (response.status == 200) {
            let { data } = await this.$store.dispatch('getMyUser')
            console.log({ data: data.role })
            if (data.role != 1)
              return (this.validationMsg = "You're not admin 🔒")
            this.validationMsg = 'Welcome Back 👌'
            window.location.href = '/'
          }
        })
        .catch(({ response: { status } }) => {
          return (this.validationMsg =
            'Whoops your email or password is wrong 😵!')
        })
    }
  }
}
</script>

<style>
.bg-dark {
  background-color: whitesmoke;
}
</style>
