// const FilterApp = {
//   // currentPage: 1,
//   // pageSize: 20,
//   // totalPages: 1,
//   init: function () {
//     this.bindEvents();
//   },

//   bindEvents: function () {
//     $(".filter-checkbox").on("input", this.fetchFilteredProducts);
//     // $('#prev-page').on('click', this.prevPage.bind(this));
//     // $('#next-page').on('click', this.nextPage.bind(this));
//   },

//   fetchFilteredProducts: function () {
//     let formData = FilterApp.collectFilterData();
//     FilterApp.updateEncodedURL(formData);
//     $("#products-container").html("<p>Loading products...</p>");
//     $.ajax({
//       url: "http://localhost/mvc_main/catalog/product/list/",
//       type: "GET",
//       data: formData,
//       success: function (response) {
//         let $response = $(response);
//         console.log($response);
//         let $products = $response.find(".products-grid");
//         console.log($products.length);
//         let $productsGrid = $response.find(".products-grid");
//         $("#products-container").html($productsGrid);
//       },
//       error: function (error) {
//         console.log("Error fetching products:", error);
//         $("#products-container").html(
//           "<p>Failed to load products. Please try again.</p>"
//         );
//       },
//     });
//   },
//   syncPriceInputs: function () {
//     $("#max-price").val($("#price-slider").val());
//     FilterApp.fetchFilteredProducts();
//   },
//   debounce: function (func, delay) {
//     let timer;
//     return function () {
//       clearTimeout(timer);
//       timer = setTimeout(() => func.apply(this, arguments), delay);
//     };
//   },

//   updateEncodedURL: function (filters) {
//     try {
//       let jsonString = JSON.stringify(filters);
//       let encodedData = btoa(jsonString);

//       window.history.pushState({}, "", `?data=${encodedData}`);
//     } catch (error) {
//       console.error("Encoding failed:", error);
//     }
//   },

//   fetchProductsFromEncodedURL: function () {
//     let urlParams = new URLSearchParams(window.location.search);
//     let encodedData = urlParams.get("data");

//     console.log(encodedData);

//     if (encodedData) {
//       try {
//         let decodedData = atob(encodedData);
//         console.log(encodedData);

//         console.log(encodedData);
//         let filters = JSON.parse(decodedData);

//         if (filters) {
//           FilterApp.restoreFilters(filters);
//           this.fetchFilteredProducts();
//         }
//       } catch (error) {
//         console.error("Decoding failed:", error);
//       }
//     }
//   },

//   restoreFilters: function (filters) {
//     $.each(filters, function (key, value) {
//       if (Array.isArray(value)) {
//         $('.filter-checkbox[name="' + key + '"]').each(function () {
//           $(this).prop("checked", value.includes($(this).val()));
//         });
//       } else {
//         $("#" + key).val(value);
//       }
//     });
//   },

//   collectFilterData: function () {
//     let filters = {};
//     $(".filter-checkbox:checked").each(function () {
//       let name = $(this).attr("name");
//       if (!filters[name]) {
//         filters[name] = [];
//       }
//       filters[name].push($(this).val());
//     });
//     console.log(filters);
//     return filters;
//   },
//   searchInput: function () {
//     $("#search-input").on("input", function () {
//       let input = $("#search-input").val().toLowerCase();
//       $(".product").each(function () {
//         let productName = $(this).find(".product-name").text().toLowerCase();
//         console.log(productName);

//         if (productName.includes(input)) {
//           $(this).show();
//         } else {
//           $(this).hide();
//         }
//       });
//       console.log(input);
//     });
//   },
//   sortProducts: function () {
//     $("#sort-select").on("change", function () {
//       let option = $("#sort-select").val();

//       // Get all product cards
//       let products = $(".product-card").toArray();

//       // Sort the products based on the selected option
//       products.sort((a, b) => {
//         let priceA = parseFloat(
//           $(a).find(".product-price").text().substring(1)
//         );
//         let priceB = parseFloat(
//           $(b).find(".product-price").text().substring(1)
//         );

//         if (option === "price-asc") {
//           return priceA - priceB;
//         } else if (option === "price-desc") {
//           return priceB - priceA;
//         }
//       });
//       $("#products-container").empty();
//       products.forEach((product) => {
//         $("#products-container").append(product);
//       });
//     });
//   },

//   priceRange: function () {
//     $(".price-inputs").on("change", function () {
//       let min = parseFloat($("#min-price").val());
//       let max = parseFloat($("#max-price").val());
//       let products = $(".product").toArray();

//       // console.log(
//       //     typeof(max));
//       products.forEach((product) => {
//         let productPrice = $(product)
//           .find(".product-price")
//           .text()
//           .substring(1);
//         console.log(productPrice);
//         if (productPrice >= min && productPrice <= max) {
//           $(product).show();
//         } else {
//           $(product).hide();
//         }
//       });
//     });
//   },
// };

// $(document).ready(function () {
//   FilterApp.init();
//   FilterApp.fetchProductsFromEncodedURL();
//   FilterApp.searchInput();
//   FilterApp.sortProducts();
//   FilterApp.priceRange();
// });
// $(document).on("click", ".attribute-header", function () {
//   console.log("Header clicked:", this);
//   toggleAttribute(this);
// });

// function toggleAttribute(header) {
//   console.log(header); // Check if this logs the element
//   var options = $(header).next(".attribute-options");

//   if (options.length > 0) {
//     options.slideToggle(300).toggleClass("active");
//   } else {
//     console.warn("No options found for:", header);
//   }
// }
const FilterApp = {
  init: function () {
    this.bindEvents();
  },

  bindEvents: function () {
    $(".filter-checkbox").on("input", this.fetchFilteredProducts);
  },

  fetchFilteredProducts: function () {
    let formData = FilterApp.collectFilterData();
    FilterApp.updateURL(formData);
    $("#products-container").html("<p>Loading products...</p>");
    $.ajax({
      url: "http://localhost/mvc_main/catalog/product/list/",
      type: "GET",
      data: formData,
      success: function (response) {
        let $response = $(response);
        let $productsGrid = $response.find(".products-grid");
        $(".products").html($productsGrid);
      },
      error: function (error) {
        console.log("Error fetching products:", error);
        $("#products-container").html(
          "<p>Failed to load products. Please try again.</p>"
        );
      },
    });
  },

  updateURL: function (filters) {
    let urlParams = new URLSearchParams(window.location.search);

    // Merge existing parameters with new filters
    Object.keys(filters).forEach((key) => {
      urlParams.set(key, filters[key]); // Add or update parameter
    });

    // Ensure parameters like 'limit' and 'page' are not duplicated
    let existingParams = new URLSearchParams(window.location.search);
    existingParams.forEach((value, key) => {
      if (!Object.keys(filters).includes(key)) {
        urlParams.set(key, value);
      }
    });

    window.history.pushState({}, "", `?${urlParams.toString()}`);
  },

  fetchProductsFromURL: function () {
    let urlParams = new URLSearchParams(window.location.search);
    let filters = {};

    urlParams.forEach((value, key) => {
      filters[key] = value.split(",");
    });

    if (Object.keys(filters).length > 0) {
      FilterApp.restoreFilters(filters);
      this.fetchFilteredProducts();
    }
  },

  restoreFilters: function (filters) {
    $.each(filters, function (key, value) {
      if (Array.isArray(value)) {
        $('.filter-checkbox[name="' + key + '"]').each(function () {
          $(this).prop("checked", value.includes($(this).val()));
        });
      } else {
        $("#" + key).value = value;
      }
    });
  },
  collectFilterData: function () {
    let filters = {};
    $(".filter-checkbox:checked").each(function () {
      let name = $(this).attr("name");
      if (!filters[name]) {
        filters[name] = [];
      }
      filters[name].push($(this).val());
    });
    return filters;
  },
  searchInput: function () {
    $("#search-input").on("input", function () {
      let input = $("#search-input").val().toLowerCase();
      $(".product").each(function () {
        let productName = $(this).find(".product-name").text().toLowerCase();
        console.log(productName);

        if (productName.includes(input)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
      console.log(input);
    });
  },
  sortProducts: function () {
    $("#sort-select").on("change", function () {
      let option = $("#sort-select").val();

      // Get all product cards
      let products = $(".product-card").toArray();

      // Sort the products based on the selected option
      products.sort((a, b) => {
        let priceA = parseFloat(
          $(a).find(".product-price").text().substring(1)
        );
        let priceB = parseFloat(
          $(b).find(".product-price").text().substring(1)
        );

        if (option === "price-asc") {
          return priceA - priceB;
        } else if (option === "price-desc") {
          return priceB - priceA;
        }
      });
      $("#products-container").empty();
      products.forEach((product) => {
        $("#products-container").append(product);
      });
    });
  },

  priceRange: function () {
    $(".price-inputs").on("change", function () {
      let min = parseFloat($("#min-price").val());
      let max = parseFloat($("#max-price").val());
      let products = $(".product").toArray();

      // console.log(
      //     typeof(max));
      products.forEach((product) => {
        let productPrice = $(product)
          .find(".product-price")
          .text()
          .substring(1);
        console.log(productPrice);
        if (productPrice >= min && productPrice <= max) {
          $(product).show();
        } else {
          $(product).hide();
        }
      });
    });
  },
};

$(document).ready(function () {
  FilterApp.init();
  FilterApp.fetchProductsFromEncodedURL();
  FilterApp.searchInput();
  FilterApp.sortProducts();
  FilterApp.priceRange();
});
