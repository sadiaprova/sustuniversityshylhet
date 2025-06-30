const menuItems = {
  breakfast: [
    { name: "Tea", price: 10 },
    { name: "Coffee", price: 15 },
    { name: "Butter", price: 5 },
    { name: "Bread", price: 8 }
  ],
  lunch: [
    { name: "Biryani", price: 120 },
    { name: "Fried Rice", price: 80 },
    { name: "Noodles", price: 70 }
  ],
  dinner: [
    { name: "Soup", price: 40 },
    { name: "Momos", price: 90 },
    { name: "Pasta", price: 100 },
    { name: "Pizza", price: 150 },
    { name: "CocaCola", price: 30 },
    { name: "Burger and Fries", price: 110 }
  ]
};

let order = [];

function renderMenu() {
  for (const [meal, items] of Object.entries(menuItems)) {
    const container = document.getElementById(meal);
    items.forEach(item => {
      const div = document.createElement("div");
      div.className = "menu-item";
      div.innerHTML = `<strong>${item.name}</strong><br/>$${item.price}<br/><button onclick="addToOrder('${item.name}', ${item.price})">Add to Order</button>`;
      container.appendChild(div);
    });
  }
}

function addToOrder(name, price) {
  order.push({ name, price });
  updateOrderDisplay();
}

function updateOrderDisplay() {
  const orderList = document.getElementById("orderList");
  orderList.innerHTML = "";
  let total = 0;
  order.forEach(item => {
    total += item.price;
    const li = document.createElement("li");
    li.textContent = `1x ${item.name} - $${item.price}`;
    orderList.appendChild(li);
  });
  document.getElementById("total").textContent = total;
}

function placeOrder() {
  const studentId = document.getElementById("studentId").value;
  const response = document.getElementById("response");
  response.textContent = "";

  if (!studentId) {
    response.textContent = "Please enter a student ID.";
    return;
  }

  fetch("order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ studentId, order })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        response.style.color = "green";
        response.textContent = "Order placed successfully!";
        order = [];
        updateOrderDisplay();
      } else {
        response.style.color = "red";
        response.textContent = data.message;
      }
    });
}

renderMenu();
