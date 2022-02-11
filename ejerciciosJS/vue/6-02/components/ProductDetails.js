app.component('product-details', {
    props: {
        details: {
            type: Array,
            required: true
        }
    },
    template:
        /*html*/
        `        <p v-if="details">LISTA DE TALLAS:</p>
    <ul>
      <li v-for="detail in details">{{ detail }}</li>
    </ul>`,
    data() {
        return {}
    },
    computed: {}
})