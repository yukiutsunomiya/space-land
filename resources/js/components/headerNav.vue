<template>
    <ul class="navbar-nav">
              <li class="nav-item dropdown py-2">
                <a class="nav-link dropdown-toggle fw-bold" to="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    HOME
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><router-link class="dropdown-item" to="/">ABOUT</router-link></li>
                  <li><router-link class="dropdown-item" to="/">CONTACT</router-link></li>
                </ul>
              </li>
            </ul>
</template>
<!--
    <script>
  export default{
    data(){
      return{
        products:[], 
        session:this.$route.query.session
      }
    },
    mounted:{
        function () {
            jQuery(function ($) {
                $(".dropdown-toggle").click(function () {
                    var location = $(this).attr('href');
                    window.location.href = location;
                    return false;
                })
            })
        }
    }
  }
  </script>


-->
