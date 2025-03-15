    // <style>
    // /* Main styling and reset */
    // * {
    //     margin: 0;
    //     padding: 0;
    //     box-sizing: border-box;
    //     font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    // }

    // body {
    //     background-color: #f8f9fa;
    //     color: #343a40;
    //     line-height: 1.6;
    //     padding: 20px;
    //     display: flex;
    //     justify-content: center;
    // }

    // /* Layout structure */
    // .filters {
    //     display: flex;
    //     max-width: 1400px;
    //     margin: 0 auto;
    //     gap: 30px;
    // }

    // .filter-section {
    //     background-color: white;
    //     border-radius: 12px;
    //     padding: 24px;
    //     margin-bottom: 20px;
    //     box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    //     position: sticky;
    //     top: 20px;
    //     max-height: calc(100vh - 40px);
    //     overflow-y: auto;
    //     transition: all 0.3s ease;
    // }

    // .products {
    //     flex: 1;
    // }

    // /* Filters styling */
    // .filter-section h3 {
    //     font-size: 18px;
    //     color: #212529;
    //     margin-bottom: 18px;
    //     padding-bottom: 12px;
    //     border-bottom: 1px solid #e9ecef;
    //     font-weight: 600;
    //     position: relative;
    // }

    // .filter-section h3::after {
    //     content: '';
    //     position: absolute;
    //     bottom: -1px;
    //     left: 0;
    //     width: 40px;
    //     height: 3px;
    //     background-color: #0d6efd;
    //     border-radius: 2px;
    // }

    // .filter-option {
    //     margin-bottom: 14px;
    // }

    // .filter-option label {
    //     display: flex;
    //     align-items: center;
    //     cursor: pointer;
    //     transition: all 0.2s ease;
    //     font-size: 15px;
    //     color: #495057;
    //     padding: 3px 0;
    // }

    // .filter-option label:hover {
    //     color: #0d6efd;
    //     transform: translateX(3px);
    // }

    // .filter-checkbox {
    //     margin-right: 10px;
    //     appearance: none;
    //     width: 18px;
    //     height: 18px;
    //     border: 2px solid #ced4da;
    //     border-radius: 4px;
    //     cursor: pointer;
    //     position: relative;
    //     transition: all 0.2s ease;
    // }

    // .filter-checkbox:checked {
    //     background-color: #0d6efd;
    //     border-color: #0d6efd;
    // }

    // .filter-checkbox:checked::after {
    //     content: '';
    //     position: absolute;
    //     top: 2px;
    //     left: 6px;
    //     width: 4px;
    //     height: 8px;
    //     border: solid white;
    //     border-width: 0 2px 2px 0;
    //     transform: rotate(45deg);
    // }

    // /* Price range styling */
    // .price-range {
    //     padding: 12px 0;
    // }

    // .filter-range {
    //     width: 100%;
    //     margin-bottom: 18px;
    //     height: 6px;
    //     -webkit-appearance: none;
    //     appearance: none;
    //     background: linear-gradient(to right, #e9ecef, #e9ecef);
    //     outline: none;
    //     border-radius: 3px;
    // }

    // .filter-range::-webkit-slider-thumb {
    //     -webkit-appearance: none;
    //     appearance: none;
    //     width: 20px;
    //     height: 20px;
    //     border-radius: 50%;
    //     background: #0d6efd;
    //     cursor: pointer;
    //     border: 3px solid white;
    //     box-shadow: 0 2px 8px rgba(13, 110, 253, 0.4);
    // }

    // .filter-range::-moz-range-thumb {
    //     width: 20px;
    //     height: 20px;
    //     border-radius: 50%;
    //     background: #0d6efd;
    //     cursor: pointer;
    //     border: 3px solid white;
    //     box-shadow: 0 2px 8px rgba(13, 110, 253, 0.4);
    // }

    // .price-inputs {
    //     display: flex;
    //     justify-content: space-between;
    //     gap: 10px;
    // }

    // .filter-price {
    //     flex: 1;
    //     padding: 10px 12px;
    //     border: 1px solid #ced4da;
    //     border-radius: 6px;
    //     font-size: 14px;
    //     outline: none;
    //     transition: all 0.2s ease;
    //     background-color: #f8f9fa;
    // }

    // .filter-price:focus {
    //     border-color: #0d6efd;
    //     background-color: white;
    //     box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    // }

    // /* Products section styling */
    // .products-header {
    //     display: flex;
    //     justify-content: space-between;
    //     align-items: center;
    //     margin-bottom: 24px;
    //     background-color: white;
    //     padding: 18px 24px;
    //     border-radius: 12px;
    //     box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    // }

    // .products-header h2 {
    //     font-size: 22px;
    //     font-weight: 600;
    //     color: #212529;
    // }

    // #search-input {
    //     flex-grow: 1;
    //     margin: 0 20px;
    //     padding: 10px 16px;
    //     border: 1px solid #ced4da;
    //     border-radius: 6px;
    //     font-size: 15px;
    //     outline: none;
    //     transition: all 0.2s ease;
    //     background-color: #f8f9fa;
    //     width: 100%;
    //     max-width: 400px;
    // }

    // #search-input:focus {
    //     border-color: #0d6efd;
    //     background-color: white;
    //     box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    // }

    // .sort-select {
    //     padding: 10px 16px;
    //     border: 1px solid #ced4da;
    //     border-radius: 6px;
    //     font-size: 15px;
    //     background-color: #f8f9fa;
    //     cursor: pointer;
    //     outline: none;
    //     transition: all 0.2s ease;
    //     color: #495057;
    //     min-width: 170px;
    //     background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    //     background-repeat: no-repeat;
    //     background-position: right 10px center;
    //     padding-right: 30px;
    //     appearance: none;
    // }

    // .sort-select:focus {
    //     border-color: #0d6efd;
    //     background-color: white;
    //     box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    // }

    // /* Products grid styling */
    // .products-grid {
    //     display: grid;
    //     grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    //     gap: 25px;
    // }

    // .product-card {
    //     background-color: white;
    //     border-radius: 12px;
    //     overflow: hidden;
    //     box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    //     transition: all 0.3s ease;
    //     position: relative;
    //     display: flex;
    //     flex-direction: column;
    // }

    // .product-card:hover {
    //     transform: translateY(-5px);
    //     box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    // }

    // .product-image {
    //     width: 100%;
    //     height: 220px;
    //     object-fit: cover;
    //     transition: transform 0.5s ease;
    // }

    // .product-card:hover .product-image {
    //     transform: scale(1.05);
    // }

    // .product-name {
    //     font-size: 17px;
    //     font-weight: 600;
    //     color: #212529;
    //     margin: 18px 18px 10px;
    //     line-height: 1.3;
    //     min-height: 44px;
    //     display: -webkit-box;
    //     -webkit-line-clamp: 2;
    //     -webkit-box-orient: vertical;
    //     overflow: hidden;
    // }

    // .product-price {
    //     font-size: 20px;
    //     font-weight: 700;
    //     color: #0d6efd;
    //     margin: 0 18px 18px;
    // }

    // .add-to-cart {
    //     width: 100%;
    //     padding: 14px 0;
    //     background-color: #0d6efd;
    //     color: white;
    //     border: none;
    //     font-size: 16px;
    //     font-weight: 500;
    //     cursor: pointer;
    //     transition: all 0.2s ease;
    //     margin-top: auto;
    //     text-transform: uppercase;
    //     letter-spacing: 0.5px;
    // }

    // .add-to-cart:hover {
    //     background-color: #0b5ed7;
    // }

    // /* Empty state styling */
    // .no-products {
    //     text-align: center;
    //     padding: 40px;
    //     background-color: white;
    //     border-radius: 12px;
    //     box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    // }

    // .no-products h3 {
    //     font-size: 20px;
    //     color: #495057;
    //     margin-bottom: 10px;
    // }

    // .no-products p {
    //     color: #6c757d;
    // }

    // /* Attribute dropdown styling - NEW */
    // .attribute-dropdown {
    //     margin-bottom: 20px;
    //     border-bottom: 1px solid #e9ecef;
    //     padding-bottom: 10px;
    // }

    // .attribute-header {
    //     display: flex;
    //     justify-content: space-between;
    //     align-items: center;
    //     cursor: pointer;
    //     padding: 10px 0;
    //     transition: all 0.2s ease;
    // }

    // .attribute-header:hover {
    //     color: #0d6efd;
    // }

    // .attribute-header h4 {
    //     font-size: 16px;
    //     font-weight: 600;
    //     margin: 0;
    // }

    // .attribute-toggle {
    //     width: 20px;
    //     height: 20px;
    //     display: flex;
    //     align-items: center;
    //     justify-content: center;
    //     transition: transform 0.3s ease;
    // }

    // .attribute-toggle.active {
    //     transform: rotate(180deg);
    // }

    // .attribute-toggle:before {
    //     content: '';
    //     border: solid #495057;
    //     border-width: 0 2px 2px 0;
    //     display: inline-block;
    //     padding: 3px;
    //     transform: rotate(45deg);
    //     transition: border-color 0.2s ease;
    // }

    // .attribute-header:hover .attribute-toggle:before {
    //     border-color: #0d6efd;
    // }

    // .attribute-options {
    //     max-height: 0;
    //     overflow: hidden;
    //     transition: max-height 0.3s ease;
    //     padding-left: 10px;
    // }

    // .attribute-options.active {
    //     max-height: 500px;
    // }

    // .attribute-option {
    //     margin: 8px 0;
    //     display: flex;
    //     align-items: center;
    // }

    // .attribute-option label {
    //     display: flex;
    //     align-items: center;
    //     cursor: pointer;
    //     font-size: 14px;
    //     color: #495057;
    //     transition: color 0.2s ease;
    // }

    // .attribute-options {
    //     max-height: 0;
    //     overflow: hidden;
    //     transition: max-height 0.3s ease;
    //     padding-left: 10px;
    // }

    // .attribute-options.active {
    //     max-height: 500px;
    // }

    // .attribute-option label:hover {
    //     color: #0d6efd;
    // }

    // /* Badge icon for active filters */
    // .filter-badge {
    //     position: relative;
    // }

    // .filter-badge::after {
    //     content: attr(data-count);
    //     position: absolute;
    //     top: -8px;
    //     right: -8px;
    //     background-color: #dc3545;
    //     color: white;
    //     font-size: 10px;
    //     font-weight: bold;
    //     min-width: 16px;
    //     height: 16px;
    //     border-radius: 50%;
    //     display: flex;
    //     align-items: center;
    //     justify-content: center;
    //     opacity: 0;
    //     transition: opacity 0.2s ease;
    // }

    // .filter-badge.active::after {
    //     opacity: 1;
    // }

    // /* Improved buttons */
    // .filter-actions {
    //     display: flex;
    //     justify-content: space-between;
    //     margin-top: 20px;
    //     padding-top: 15px;
    //     border-top: 1px solid #e9ecef;
    // }

    // .filter-button {
    //     padding: 10px 15px;
    //     border-radius: 6px;
    //     font-size: 14px;
    //     font-weight: 500;
    //     cursor: pointer;
    //     transition: all 0.2s ease;
    //     border: none;
    // }

    // .apply-filter {
    //     background-color: #0d6efd;
    //     color: white;
    // }

    // .apply-filter:hover {
    //     background-color: #0b5ed7;
    // }

    // .reset-filter {
    //     background-color: #f8f9fa;
    //     color: #495057;
    //     border: 1px solid #ced4da;
    // }

    // .reset-filter:hover {
    //     background-color: #e9ecef;
    // }

    // /* Animation effects */
    // @keyframes fadeIn {
    //     from {
    //         opacity: 0;
    //         transform: translateY(10px);
    //     }

    //     to {
    //         opacity: 1;
    //         transform: translateY(0);
    //     }
    // }

    // .product-card {
    //     animation: fadeIn 0.3s ease forwards;
    // }

    // /* Responsive design */
    // @media (max-width: 1024px) {
    //     .filters {
    //         flex-direction: column;
    //     }

    //     .filter-section {
    //         flex: 0 0 auto;
    //         width: 100%;
    //         position: static;
    //         max-height: none;
    //     }

    //     .products-grid {
    //         grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    //     }

    //     .products-header {
    //         flex-wrap: wrap;
    //         gap: 15px;
    //     }

    //     .products-header h2 {
    //         width: 100%;
    //     }

    //     #search-input {
    //         order: 3;
    //         margin: 0;
    //         flex-basis: 100%;
    //         max-width: none;
    //     }
    // }

    // @media (max-width: 767px) {
    //     .products-header {
    //         flex-direction: column;
    //         align-items: flex-start;
    //         gap: 15px;
    //     }

    //     .sort-select {
    //         width: 100%;
    //     }

    //     .products-grid {
    //         grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    //         gap: 15px;
    //     }

    //     .product-image {
    //         height: 160px;
    //     }

    //     .product-name {
    //         font-size: 15px;
    //         margin: 12px 12px 6px;
    //         min-height: 40px;
    //     }

    //     .product-price {
    //         font-size: 17px;
    //         margin: 0 12px 12px;
    //     }

    //     .add-to-cart {
    //         padding: 12px 0;
    //         font-size: 14px;
    //     }
    // }
    // </style>