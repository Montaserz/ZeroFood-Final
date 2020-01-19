<template>
  <v-row>
    <v-col cols="12" style="padding: 0px;">
      <v-card class=" mx-auto">
        <v-row justify="space-between" align="center">
          <v-col
            xs="12"
            md="6"
            class="text-center pl-0"
            style="padding: 0px !important;"
          >
            <v-img
              src="https://cdn.dribbble.com/users/1355613/screenshots/6807438/food_delivery_2x.jpg"
            />
          </v-col>
          <v-col xs="12" md="6" class="px-4">
            <h1 class="title pb-4 px-4">Create new Account with us 😀</h1>
            <p
              class="white--text text-center py-2 px-4"
              :style="`background-color:#00b894 !important;`"
              v-if="validationMsg != ''"
            >
              {{ validationMsg }}
            </p>
            <v-card-text class="pt-4">
              <p
                :style="`background-color:#00b894 !important;`"
                class="white--text text-center bg-dark py-2 px-4"
                v-if="validationMsg != ''"
              >
                {{ validationMsg }}
              </p>
              <div>
                <v-form ref="form">
                  <v-text-field
                    label="Enter your name"
                    v-model="name"
                    required
                  ></v-text-field>
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
                      @click="registration"
                      class="white--text w-100"
                      :style="`background-color:#00b894 !important;`"
                      >Sign Up Now 👯!</v-btn
                    >
                  </v-layout>
                </v-form>
              </div>
            </v-card-text>
            <p class="text-center">
              Already have an account ?
              <router-link to="/login" style="color: #00b894 !important;"
                >Login</router-link
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
import { setTimeout } from 'timers'
export default {
  name: 'Registration',
  data() {
    return {
      email: '',
      password: '',
      name: '',
      validationMsg: ''
    }
  },
  methods: {
    registration() {
      var mediumRegex = new RegExp(
        '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})'
      )
      if (!this.name) return (this.validationMsg = 'Name is Required 📛')
      let emailVaild = /\S+@\S+\.\S+/
      if (!this.email) return (this.validationMsg = 'Email is Required ✉️')
      if (!emailVaild.test(this.email))
        return (this.validationMsg = 'Email must be vaild ')
      if (!this.password)
        return (this.validationMsg = 'Password is Required 👩‍💻')
      if (this.password.length <= 6)
        return (this.validationMsg =
          'Password length must be more than 6 characters 🔐')
      if (!mediumRegex.test(this.password))
        return (this.validationMsg =
          'Password should content at least 1 lowercase and uppercase alphabetical character ,  at least 1 number & at least 1 special character  and password length must be more than 6 characters 🔐')
      this.validationMsg = ''
      this.$store
        .dispatch('registration', {
          name: this.name,
          email: this.email,
          password: this.password
        })
        .then(({ response }) => {
          this.validationMsg = 'Registration Done 👌'
          setTimeout(() => {
            this.$router.push('/')
          }, 500)
        })
        .catch(({ response: { status, data } }) => {
          this.validationMsg = `${data.email[0]} 😵`
        })
    }
  }
}
</script>

<style></style>
