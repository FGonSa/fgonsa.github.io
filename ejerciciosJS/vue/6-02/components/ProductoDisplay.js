app.component('producto-display', {
    props: {
        premium: {
            type: Boolean,
            required: true
        },
        details: {
            type: Array,
            required: true
        }
    },
    template:
        /*html*/
        `<div class="product-display">
    <div class="product-container">
      <div class="product-image">
        <!-- image goes here -->
        <a v-bind:href="url">
          <img v-bind:src="imagen" alt="" srcset="">
        </a>
      </div>
      <div class="product-info">
        <h1>{{ titulo }}</h1>
        <p>{{ description }}</p>
        <p v-if="enStock">En Stock</p>
        <p v-else class="decorado">En Stock </p><br>

<p>Gastos de Envío: {{ shipping }}</p>
        
<product-details :details="details"></product-details>

        <div   
        v-for="(variant, index) in variants" 
        :key="variant.id" 
        @mouseover="updateVariant(index)"
        class="color-circle" 
        :style="{ backgroundColor: variant.color }"></div>
        
        <button class="button" v-on:click="addCesta" :disabled="!enStock" :class="{ disabledButton: !enStock }">Añadir a la Cesta</button>
        <button class="button" v-on:click="restarCesta" :disabled="!enStock" :class="{ disabledButton: !enStock }">Retirar de la Cesta</button>
        <button class="button" v-on:click="cambiarStock">Cambiar el Stock</button>
      </div>
    </div>
  </div>`,

    data() {
        return {
            product: 'Calcetines',
            marca: 'Politècnics',
            image: './assets/images/socks_green.jpg',
            description: "Par de calcetines suavecicos",
            url: 'http://www.google.com',
            stock: true,
            variants: [{
                    id: 2234,
                    color: 'green',
                    image: './assets/images/socks_green.jpg',
                    cantidad: 50
                },
                {
                    id: 2235,
                    color: 'blue',
                    image: './assets/images/socks_blue.jpg',
                    cantidad: 0
                },
            ],
            selectedVariant: 0,
        }
    },
    methods: {
        addCesta() {
            this.$emit('add-cesta', this.variants[this.selectedVariant].id)
        },
        restarCesta() {
            this.$emit('restar-cesta', this.variants[this.selectedVariant].id)
        },
        cambiarStock() {
            if (this.stock) {
                this.stock = false
            } else {
                this.stock = true
            }
        },
        updateVariant(index) {
            this.selectedVariant = index;
        }
    },
    computed: {
        titulo() {
            return this.product + ' ' + this.marca
        },
        imagen() {
            return this.variants[this.selectedVariant].image
        },
        enStock() {
            return this.variants[this.selectedVariant].cantidad
        },
        shipping() {
            if (this.premium) {
                return 'Gratis'
            } else {
                return '3,00 €'
            }
        }
    }
})