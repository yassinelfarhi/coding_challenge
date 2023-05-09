<template>
  <div>
    <form @submit.prevent="createProduct" method="POST">
      <div>
        <label>Name:</label>
        <input type="text" v-model="newProduct.name">
      </div>
      <div>
        <label>Description:</label>
        <textarea v-model="newProduct.description"></textarea>
      </div>
      <div>
        <label>Price:</label>
        <input type="number" v-model="newProduct.price">
      </div>
      <div>
        <label>Category:</label>
        <input type="text" v-model="newProduct.category">
      </div>
      <div>
      <button type="submit">Create</button>
      </div>
    </form>


<div id="tableblock">

      <div>
      <label for="sort">Sort by:</label>
      <select name="sort" id="sort" v-model="selectedSort" @change="sortProducts">
        <option value="">--select--</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
      </select>
    </div>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.category }}</td>
        </tr>
      </tbody>
    </table>
  </div>  
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      newProduct: {
        name: '',
        description: '',
        price: '',
        category: ''
      },
      selectedSort: ''
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get('/api/products')
          .then(response => {
            this.products = response.data;
          })
         .catch(error => {
            console.log(error);
          });

    },
    createProduct() {
      axios.post('/products/persiste',this.newProduct)
      .catch( error => {
        console.log(error);
      })
      this.products.push(this.newProduct);

    },
    sortProducts() {
      if (this.selectedSort === 'price_asc') {
        this.products.sort((a, b) => a.price - b.price);
      } else if (this.selectedSort === 'price_desc') {
        this.products.sort((a, b) => b.price - a.price);
      }
    }
  }

};
</script>