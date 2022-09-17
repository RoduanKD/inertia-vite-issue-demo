<template>
  <v-container>
    <v-row justify="center">
      <v-col sm="8">
        <div class="text-h4">
          {{ survey.name }}
        </div>
        <v-card
          v-for="question in questions"
          :key="question.id"
          class="my-4"
        >
          <v-card-title>
            {{ question.content }}
          </v-card-title>
          <v-card-text>
            <v-text-field
              v-if="question.type === 'text'"
              v-model="answers[`q${question.id}`]"
              label="Text Answer"
            />
            <v-text-field
              v-if="question.type === 'number'"
              v-model="answers[`q${question.id}`]"
              label="Numeric Answer"
              type="number"
            />
            <div v-if="question.type === 'radio'">
              <v-radio-group v-model="answers[`q${question.id}`]">
                <v-radio
                  v-for="(option, j) in question.options"
                  :key="j"
                  :label="option"
                  :value="option"
                />
              </v-radio-group>
            </div>
          </v-card-text>
        </v-card>

        <v-btn
          color="primary"
          @click="submit"
        >
          Submit
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AppLayout from '@/layouts/AppLayout'

export default {
  name: 'EntryCreate',
  layout: AppLayout,
  props: {
    survey: {
      type: Object,
      default: () => ({}),
    },
  },
  data () {
    return {
      answers: {},
    }
  },
  computed: {
    questions () {
      return this.survey.questions
    },
  },
  methods: {
    submit () {
      this.$inertia.post(route('surveys.entries.store', this.survey.id), this.answers)
    },
  },
}
</script>
