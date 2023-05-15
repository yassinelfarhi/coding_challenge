<template>
  <div class="container">

    <div class="form-container">
        <form @submit.prevent="createProduct" method="POST">

          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-input" v-model="newProduct.name">
          </div>

          <div class="form-group">
            <label>Description:</label>
            <textarea class="form-input" v-model="newProduct.description"></textarea>
          </div>

          <div class="form-group">
            <label>Price:</label>
            <input type="number" class="form-input" v-model="newProduct.price">
          </div>

          <div class="form-group">
            <label>Category:</label>
            <select name="filter" id="filter" class="form-input" v-model="newProduct.category.name">
              <option value="men">MEN</option>
              <option value="women">WOMEN</option>
              <option value="children">children</option>
            </select>
          </div>

          <div>
          <button type="submit" class="submit-button">Create</button>
          </div>
        </form>
    </div>


<div id="tableblock">


      <div class="filter-sort-container">
        <div class="sort-container">
          <label for="sort">Sort by:</label>
          <select name="sort" id="sort" v-model="selectedSort" @change="sortProducts">
            <option value="">--select--</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
          </select>
        </div>

        <div class="filter-container">
          <label for="sort">Filter by Category:</label>
          <select name="sort" id="sort" v-model="selectedCategory" @change="filterProducts">
            <option v-for="category in categories" :key="category.id" :value=category.name> {{ category.name }} </option>
          </select>
        </div>

      </div>

      <div class="table-container">
        <table class="product-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Category</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in filtredProducts" :key="product.id">
              <td>{{ product.name }}</td>
              <td>{{ product.description }}</td>
              <td>{{ product.price }}</td>
              <td>{{ product.category["name"] }}</td>
            </tr>
          </tbody>
        </table>
      </div>  

  </div>  
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      categories: [],
      newProduct: {
        name: '',
        description: '',
        price: '',
        category: { name: ''} ,
      },
      selectedSort: '',
      selectedCategory: ''
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
  computed: {
    filtredProducts(){
      if(this.selectedCategory){
        return this.products.filter( ( product ) => product.category.name == this.selectedCategory );
      } else {
        return this.products;
      }
    }
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
    },
    fetchCategories(){
      axios.get('/api/categories')
            .then(response => {
                                this.categories = response.data;
                              });

            
    }
  }

};
</script>
<style>
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f1f1f1;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.filter-container,
.sort-container {
  display: flex;
  align-items: center;
  padding: 2%;
}

.label {
  font-weight: bold;
  margin-right: 10px;
}

.table-container {
  max-width: 600px;
  margin: 0 auto;
}

.product-table {
  width: 100%;
  border-collapse: collapse;
}

.product-table th,
.product-table td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.product-table th {
  text-align: left;
  background-color: #f1f1f1;
}

.product-table td {
  text-align: center;
}

.form-container {
  max-width: 400px;
  margin: 0 auto;
}

.form-container {
  max-width: 400px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

.form-input {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.select-input {
  width: 100%;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.submit-button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 3px;
  font-size: 16px;
  cursor: pointer;
}
#tableblock {
  display: grid;
}

.filter-sort-container {
    display: flex;
    justify-content: center;
}

</style>