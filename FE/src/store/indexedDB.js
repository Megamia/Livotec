import { openDB } from "idb";

const dbPromise = openDB("myDatabase", 2, {
  upgrade(db) {
    const stores = ["products", "detailProduct", "cart", "compare", "category"];

    stores.forEach((store) => {
      if (!db.objectStoreNames.contains(store)) {
        db.createObjectStore(store, { keyPath: "id" });
      }
    });
  },
});

export const getAllDataFromIndexedDB = async () => {
  const db = await dbPromise;
  const stores = ["products", "detailProduct", "cart", "compare", "category"];

  let allData = {};

  for (const storeName of stores) {
    allData[storeName] = await db.getAll(storeName);
  }

  return allData;
};

export const saveDataToIndexedDB = async (storeName, data) => {
  try {
    const db = await dbPromise;
    const tx = db.transaction(storeName, "readwrite");
    const store = tx.objectStore(storeName);
    const timestamp = Date.now();

    for (const item of data) {
      try {
        item.timestamp = timestamp;

        store.put(item);
      } catch (err) {
        console.error("Lỗi khi lưu item:", item, err);
      }
    }
    await tx.done;
  } catch (error) {
    console.error("Lỗi khi lưu dữ liệu vào IndexedDB:", error);
  }
};

export const getDataFromIndexedDB = async (storeName) => {
  const db = await dbPromise;
  return db.getAll(storeName);
};

export const clearDataFromIndexedDB = async (storeName) => {
  const db = await dbPromise;
  const tx = db.transaction(storeName, "readwrite");
  tx.objectStore(storeName).clear();
  await tx.done;
};
