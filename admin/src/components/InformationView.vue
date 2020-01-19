<template>
  <div id="content">
    <v-row class="my-3">
      <v-col cols="12">
        <h1
          class="title text-center title my-2 "
          style="font-size:40px !important;margin: 10px 0px !important;color: #00b894 !important;"
        >
          Some tweets about us ✨
        </h1>
      </v-col>
      <v-col xs="12" md="3" v-for="(person, index) in people" :key="index">
        <v-card class="mx-auto" color="#26c6da" dark max-width="400">
          <v-card-title>
            <v-icon large left>
              mdi-twitter
            </v-icon>
            <span class="title font-weight-light">Twitter</span>
          </v-card-title>

          <v-card-text class="headline font-weight-bold">
            "{{ person.content }}"
          </v-card-text>
          <v-card-actions>
            <v-list-item class="grow">
              <v-list-item-avatar color="grey darken-3">
                <v-img class="elevation-6" :src="person.avatar"></v-img>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{ person.name }}</v-list-item-title>
              </v-list-item-content>

              <v-row align="center" justify="end">
                <v-icon class="mr-1">mdi-heart</v-icon>
                <span class="subheading mr-2">{{ person.likes }}</span>
                <span class="mr-1">·</span>
                <v-icon class="mr-1">mdi-share-variant</v-icon>
                <span class="subheading">{{ person.share }}</span>
              </v-row>
            </v-list-item>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      people: [
        {
          name: 'Evan You',
          content:
            'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
          avatar:
            'https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light',
          likes: 30,
          share: 21
        },
        {
          name: 'Evan You',
          content:
            'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
          avatar:
            'https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light',
          likes: 30,
          share: 21
        },
        {
          name: 'Evan You',
          content:
            'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
          avatar:
            'https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light',
          likes: 30,
          share: 21
        }
      ]
    }
  }
}
</script>

<style></style>
