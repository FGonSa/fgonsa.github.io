app.component('product-tabs', {
    props: {
        reviews: {
            type: Array,
            required: true
        },
        details: {
            type: Array,
            required: true
        },
        shipping: {
            type: String,
            required: true
        }
    },
    template:
        /*html*/
        `
    <div>
    <span class="tab" :class="{ activeTab: selectedTab === tab}" v-for="(tab, index) in tabs" :key="index" @click="selectedTab = tab">{{ tab }}</span>
    </div>

    <div v-show="selectedTab === 'Tallas'">
    <product-details :details="details"></product-details>
    </div>

    <div v-show="selectedTab === 'Envío'">
    <p>Gastos de Envío: {{ shipping }}</p>
    </div>

<!--CONTENIDO A MOSTRAR TAB -->
<div v-show="selectedTab === 'Reseñas'">
<review-list v-if="reviews.length" :reviews="reviews"></review-list>
<p v-else>Aún no hay reseñas.</p>
</div>

<!-- Product-Review en el tutorial Vue 2 -->
<div v-show="selectedTab === 'Escribir Reseña'">
<review-form ></review-form>
</div>
    `,

    data() {
        return {
            tabs: ['Tallas', 'Envío', 'Reseñas', 'Escribir Reseña'],
            selectedTab: 'Tallas',
        }
    }

})