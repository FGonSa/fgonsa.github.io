const app = Vue.createApp({
   
    data() {
        return {
            cesta: [],
            premium: true,
            details: ['talla S', 'talla M', 'talla L', 'talla XL'],
        }
    },
    methods: {
        updateCesta(id) {
            this.cesta.push(id)
        },
        removeCesta(id) {
            const index = this.cesta.indexOf(id)
            if (index > -1) {
                this.cesta.splice(index, 1)
            }
        }
    },
})