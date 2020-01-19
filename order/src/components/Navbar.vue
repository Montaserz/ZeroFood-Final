<template>
  <div>
    <v-navigation-drawer v-model="open" absolute temporary>
      <v-divider></v-divider>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title
            ><router-link class="mx-3" to="/"
              >Home</router-link
            ></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title
            ><router-link class="mx-3 " to="/orders" v-if="isLogin"
              >Orders</router-link
            ></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>
            <v-btn v-if="!isLogin" class="" @click="goTo('login')">
              Log in
            </v-btn></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>
            <v-btn class="" v-if="!isLogin" @click="goTo('registration')">
              Sign Up
            </v-btn></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>
            <div>
              <v-dialog
                v-if="isLogin"
                class="mx-2 "
                v-model="dialog"
                width="500"
              >
                <template v-if="isLogin" v-slot:activator="{ on }">
                  <v-btn style="rgba(0, 184, 148) !important;" v-on="on">
                    Balance - {{ user.name }} 〽️
                  </v-btn>
                </template>

                <v-card v-if="isLogin">
                  <v-divider></v-divider>

                  <v-card-text class="px-4 mt-5">
                    <p>
                      Your balance now is : {{ user.balance }}
                      <v-text-field
                        label="Amount"
                        value="0"
                        prefix="$"
                        v-model="balance"
                      ></v-text-field>
                      <center>
                        <v-btn color="dark" text @click="addBalance">
                          Add ➕
                        </v-btn>
                      </center>
                    </p>
                  </v-card-text>

                  <v-divider></v-divider>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">
                      Close ❌
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </div></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>
            <v-toolbar-title class="" @click="logout" v-if="isLogin"
              ><v-btn @click="logout">Log Out 🤐</v-btn></v-toolbar-title
            ></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
    </v-navigation-drawer>
    <nav
      :style="
        `
    background-color: rgba(0, 184, 148, 0) !important;`
      "
    >
      <v-card
        :style="`background-color: #00b894 !important;`"
        flat
        tile
        height="80px"
      >
        <v-toolbar
          :style="`background-color: #00b894 !important;`"
          dense
          height="80px"
        >
          <v-toolbar-title style="cursor: pointer"
            ><router-link
              class="mx-3 text--white d-none d-sm-flex"
              :style="`color: white !important; `"
              to="/"
              >Zero Waste Food</router-link
            ></v-toolbar-title
          >

          <v-toolbar-title style="cursor: pointer" v-if="isLogin"
            ><router-link
              class="mx-3 text--white d-none d-sm-flex"
              :style="`color: white !important; `"
              to="/orders"
              >Orders</router-link
            ></v-toolbar-title
          >

          <v-spacer></v-spacer>
          <v-btn
            color="#f5f5f5"
            class="d-flex d-sm-none"
            dark
            @click="changeOpenStatus"
          >
            <img src="http://cdn.onlinewebfonts.com/svg/img_78580.png" alt="" height="15" width="26">
          </v-btn>
          <v-btn
            v-if="!isLogin"
            class="d-none d-sm-flex"
            @click="goTo('login')"
          >
            Login
          </v-btn>
          <v-btn
            class="mx-2 text--white text--white text--white  dnp-none d-sm-flex"
            v-if="!isLogin"
            @click="goTo('registration')"
          >
            Sign Up
          </v-btn>
          <div v-if="isLogin" class="text-center d-none d-sm-flex">
            <v-dialog
              class="mx-2 text--white text--white text--white"
              v-model="dialog"
              width="500"
            >
              <template v-slot:activator="{ on }">
                <v-btn style="rgba(0, 184, 148) !important;" v-on="on">
                  Balance - {{ user.name }}️
                </v-btn>
              </template>

              <v-card>
                <v-divider></v-divider>

                <v-card-text class="px-4 mt-5">
                  <p>
                    Current balance: ${{ user.balance }}
                    <br></br>
                    <v-text-field
                            autofocus
                            outlined
                            clearable
                            single-line
                            placeholder="Amount to add"
                            hint="Amount to add"
                      prefix="$"
                      v-model="balance"
                    ></v-text-field>
                    <center>
                      <v-btn color="dark" text @click="addBalance">
                        Add ➕
                      </v-btn>
                    </center>
                  </p>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="primary" text @click="dialog = false">
                    Close ❌
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </div>
          <v-toolbar-title
            class="d-none d-sm-flex"
            @click="logout"
            v-if="isLogin"
            ><v-btn @click="logout">Log Out</v-btn></v-toolbar-title
          >
        </v-toolbar>
      </v-card>
    </nav>
  </div>
</template>

<script>
import 'vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'

export default {
  data() {
    return {
      //drawer: true,
      right: false,
      color: 'primary',
      miniVariant: false,
      expandOnHover: false,
      background: false,
      dark: true,
      links: [
        {
          title: 'Dashboard',
          to: '/',
          icon: 'mdi-view-dashboard'
        },
        {
          title: 'Users',
          to: '/users',
          icon: 'mdi-account-group'
        },

        {
          title: 'Categories',
          to: '/categories',
          icon: 'mdi-format-list-bulleted'
        },
        {
          title: 'Orders',
          to: '/orders',
          icon: 'mdi-package-variant-closed'
        },
        {
          title: 'Cart',
          to: '/carts',
          icon: 'mdi-cart-outline'
        }
      ],
      user: {},
      dialog: false,
      balance: 0,
      drawer: null,
      items: [
        { title: 'Home', icon: 'dashboard' },
        { title: 'About', icon: 'question_answer' }
      ],
      open: false,
      snackbar: false
    }
  },
  async created() {
    console.log({ login: this.isLogin })
    await this.getUser()
  },
  methods: {
    logout() {
      this.$store.dispatch('destroyToken').then(response => {
        console.log({ response })
        this.$router.push({ name: 'login' })
      })
    },
    goTo(to) {
      this.$router.push(to)
    },
    getUser() {
      this.$store.dispatch('getMyUser').then(({ data }) => {
        this.user = data
      })
    },
    addBalance() {
      // this.$store.dispatch('addBalance', this.balance).then(({ data }) => {
      //   this.user.balance = parseInt(this.user.balance) + parseInt(this.balance)
      //   this.$toasted
      //     .show(`Your Balance now is $${this.user.balance} 💰`)
      //     .goAway(1500)
      //   this.balance = ''
      // })
      this.$axios
        .get(`/user/balance/${this.balance}`, { amount: this.balance })
        .then(response => {
          console.log({ response })
          this.user.balance =
            parseInt(this.user.balance) + parseInt(this.balance)
          this.$toasted
            .show(`Your current balance now is $${this.user.balance} 💰`, {
              theme: 'bubble',
              position: 'bottom-right',
              action: [
                {
                  text: 'Cancel',
                  onClick: (e, toastObject) => {
                    toastObject.goAway(0)
                  }
                }
              ]
            })
            .goAway(1500)
          this.balance = ''
        })
    },
    changeOpenStatus() {
      this.open = !this.open
    }
  },
  computed: {
    maxHeight() {
      return `100vh`
    },
    isLogin() {
      return !this.$store.getters.loggedIn
    }
  }
}
</script>

<style scoped>
#scrolling-techniques-8 {
  overflow-x: hidden;
}
a {
  text-decoration: none !important;
  color: #757575 !important;
  transition: all 0.3s;
}

a:hover {
  color: black !important;
}
</style>
