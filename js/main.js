const products = document.getElementById("table");
console.log(products);
if (products != null) {
  products.addEventListener("click", (event) => {
    const isButton = event.target.nodeName === "BUTTON";
    if (!isButton) {
      return;
    }
    const id = event.target.dataset.id;
    const method = event.target.dataset.method;

    const data = {
      id: id,
      method: method,
    };

    if (method === "active") {
      fetch("/admin-product.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((res) => res.json())
        .then((res) => alert("Aktywowałem artykuł o id: " + res.id))
        .then((res) => window.location.reload());
    }

    if (method === "delete") {
      fetch("/admin-product.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((res) => res.json())
        .then((res) => alert(res.message))
        .then((res) => window.location.reload());
    }

    if (method === "removeFromOrder") {
      const data2 = {
        id: event.target.dataset.orderproduct,
        method: method,
      };
      console.log(data2);
      fetch("/removeOrder.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data2),
      })
        .then((res) => res.json())
        .then((res) => alert(res.message))
        .then((res) => window.location.reload());
    }
  });
}

const prod = document.getElementById("prod");

if (prod != null) {
  prod.addEventListener("click", (event) => {
    const isButton = event.target.nodeName === "BUTTON";
    if (!isButton) {
      return;
    }
    const method = event.target.dataset.method;

    const data = {
      id: event.target.dataset.id,
    };

    fetch("add-to-order.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((res) => res.json())
      .then((res) => alert(res.message));
  });
}

const form = document.getElementById("form");

if (form != null) {
  form.addEventListener("click", (e) => {
    const isButton = e.target.nodeName === "BUTTON";
    if (!isButton) {
      return;
    }
    const method = e.target.dataset.method;
    const id = e.target.dataset.id ?? null;
    const data = {
      id: id,
    };

    if (method === "closeOrder") {
      fetch("close-order.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((res) => res.json())
        .then((res) => alert(res.message))
        .then((res) => (window.location.href = "index.php"));
    }

    if (method === "acceptOrder") {
      fetch("accept-order.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((res) => res.json())
        .then((res) => alert(res.message))
        .then((res) => (window.location.href = "index.php"));
    }
  });
}
