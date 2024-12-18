<template>
    <a :href="api + 'duties'">
        <div class="new-message" style="font-size: 28px;" v-if="count > 0">
            <span class="label label-sm label-danger"> Υπάρχουν {{count}} εκκρεμότητες για σήμερα </span>
        </div>
    </a>
</template>
<script>
export default {
  data() {
    return {
      count: 0,
      api: api
    };
  },

  methods: {
    getCount() {
      axios
        .get(api + "count-duties")
        .then(response => {
          this.count = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created() {
    this.getCount();
    Echo.private("duty").listen("DutyCreated", e => {
      this.getCount();
    });
  },

  mounted() {}
};
</script>

<style>
.new-message {
  margin-right: 10px;
}
</style>
