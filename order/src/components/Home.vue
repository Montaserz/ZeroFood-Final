<template>
  <div id="Home" class="home" style>
    <template>
      <v-carousel
        cycle
        height="200"
        hide-delimiter-background
        show-arrows-on-hover
      >
        <v-carousel-item v-for="(slide, i) in slides" :key="i">
          <v-sheet
            :style="
              `background-image: url('${images[i]};background-size: cover;
               background-position: center;background-blend-mode: multiply;`
            "
            height="100%"
          >
            <v-row class="fill-height" align="center" justify="center">
              <div class="display-3">
                <p style="font-size: 20px !important;">{{ slide }}</p>
              </div>
            </v-row>
          </v-sheet>
        </v-carousel-item>
      </v-carousel>
    </template>
  </div>
</template>

<script>
export default {
  data() {
    return {
      images: [
        'https://img.pizza/1378/200',
        'https://img.pizza/1378/201',
        'https://img.pizza/1378/202'
      ],
      slides: [
        'We prepare food with ❤️',
        'Healthy food FTW! 🍖',
        'Delivery to your doorstep! 😀'
      ]
    }
  },
  methods: {
    scrollDown() {
      window.scrollTo(0, 500)
    }
  }
}
</script>

<style></style>
