export default function auth({ next, store }) {
    if (!(store.getters.get_authenticated)) {
        next("/login")
    } else {
        next();
    }
}