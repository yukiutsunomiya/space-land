import { defineStore } from 'pinia';

export const useProductStore = defineStore('product',{

  state: () => ({
    selectedProduct: null
  }),
  persist: true, // 永続化を有効化
  actions: {
    setProduct(product) {
      this.selectedProduct = product;
    },
    clearProduct() {
      this.selectedProduct = null; // 商品情報のクリア処理を追加
    }
  },
  getters: {
    hasProduct: (state) => !!state.selectedProduct // 商品が選択されているか判定
  }
});