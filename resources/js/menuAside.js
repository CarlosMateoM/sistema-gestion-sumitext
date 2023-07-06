import {
  mdiAccountCircle,
  mdiMonitor,
  mdiLock,
  mdiAlertCircle,
  mdiAccountMultiple,
  mdiTelevisionGuide,
  mdiResponsive,
  mdiPalette,
  mdiPlaylistCheck
} from "@mdi/js";

export default [
  {
    route: "dashboard",
    icon: mdiMonitor,
    label: "Resumen",
  },
  {
    route: "customers.index",
    icon: mdiAccountMultiple,
    label: "Clientes",
  },
  {
    route: "orders.index",
    icon: mdiPlaylistCheck,
    label: "Pedidos",
  },
  {
    to: "/ui",
    label: "UI",
    icon: mdiTelevisionGuide,
  },
  {
    to: "/responsive",
    label: "Responsive",
    icon: mdiResponsive,
  },
  {
    to: "/",
    label: "Styles",
    icon: mdiPalette,
  },
  {
    to: "/profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
  {
    to: "/login",
    label: "Login",
    icon: mdiLock,
  },
  {
    to: "/error",
    label: "Error",
    icon: mdiAlertCircle,
  }
  /*{
    label: "Dropdown",
    icon: mdiViewList,
    menu: [
      {
        label: "Item One",
      },
      {
        label: "Item Two",
      },
    ],
  },
  {
    href: "https://github.com/justboil/admin-one-vue-tailwind",
    label: "GitHub",
    icon: mdiGithub,
    target: "_blank",
  },
  {
    href: "https://github.com/justboil/admin-one-react-tailwind",
    label: "React version",
    icon: mdiReact,
    target: "_blank",
  }*/,
];
