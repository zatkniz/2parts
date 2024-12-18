<template>
    <div>
        <table id="prints" class="table table-hover">
            <thead>
                <tr>
                    <th> Όνομα </th>
                    <th> Δευτέρα </th>
                    <th> Τρίτη </th>
                    <th> Τετάρτη </th>
                    <th> Πέμπτη </th>
                    <th> Παρασκευή </th>
                    <th> Σάββατο </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(customer , index) in customers">
                    <td> {{customer.name}} </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <newallowance></newallowance>
        <deleteallowance></deleteallowance>
    </div>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      customers: [],
      remaining: 0
    };
  },
  methods: {},
  created() {
    axios
      .get(api + "weekly-print")
      .then(response => {
        this.customers = response.data;
        setTimeout(() => {
          $("#prints").DataTable({
            dom: "Bfrtip",
            searching: false,
            paging: false,
            ordering: false,
            buttons: [
              {
                extend: "excelHtml5",
                text: "Εξαγωγή Πελατών",
                filename: moment()
                  .locale("el")
                  .format("DD-MM-YYYY"),
                customize: function(xlsx) {
                  var sheet = xlsx.xl.worksheets["sheet1.xml"];
                  $("col", sheet).each(function() {
                    if ($(this).attr("min") != "1") {
                      $(this).attr("width", "20");
                    }
                  });
                  $("row", sheet).each(function() {
                    if ($(this).attr("r") == "1") {
                      $(this)
                        .find("t")
                        .text(
                          "Ημερομηνία: " +
                            moment()
                              .locale("el")
                              .format("D MMMM YYYY")
                        );
                    }
                  });

                //   $('row c[r^="C"]', sheet).attr("s", "51");
                }
              }
            ]
          });
        }, 500);
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>
