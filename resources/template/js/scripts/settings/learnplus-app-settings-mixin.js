export default {
  props: {
    layoutActive: {
      type: String,
      required: true
    },
    layoutLocation: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      buttonAlign: 'right',
      drawerAlign: 'end',
      options: [
        {
          id: 'layout',
          title: 'Layout',
          children: [
            {
              id: 'layout',
              title: 'Layout',
              component: 'form-image-group',
              cookies: false,
              value: 'default',
              options: [
                {
                  text: 'Layout Fluid',
                  value: 'default',
                  image: 'assets/images/navigation-side.svg',
                  selected: true
                },
                {
                  text: 'Layout Fixed',
                  value: 'fixed',
                  image: 'assets/images/navigation-top.svg'
                }
              ]
            },
            {
              id: 'rtl',
              title: 'Text Direction',
              component: 'custom-checkbox-toggle',
              options: [
                {
                  value: true
                },
                {
                  value: false,
                  selected: true
                }
              ]
            }
          ]
        },
        {
          id: 'mainDrawer',
          title: 'Main Drawer',
          children: [
            {
              id: 'align',
              title: 'Align',
              component: 'b-form-radio-group',
              options: [
                {
                  text: 'Start',
                  value: 'start',
                  selected: true
                },
                {
                  text: 'End',
                  value: 'end'
                }
              ]
            },
            {
              id: 'sidebar',
              title: 'Sidebar Skin',
              component: 'b-form-radio-group',
              options: [
                {
                  text: 'Dark',
                  value: 'dark',
                  selected: true
                },
                {
                  text: 'Light',
                  value: 'light'
                },
                {
                  text: 'Transparent',
                  value: 'transparent'
                }
              ]
            }
          ]
        },
        {
          id: 'mainNavbar',
          title: 'Main Navbar',
          children: [
            {
              id: 'navbar',
              title: 'Main Navbar',
              component: 'b-form-radio-group',
              options: [
                {
                  text: 'Primary',
                  value: 'primary',
                  selected: true
                },
                {
                  text: 'Light',
                  value: 'light'
                },
                {
                  text: 'Dark',
                  value: 'dark'
                }
              ]
            }
          ]
        }
      ],
      config: {
        'layout.layout': function(layout) {
          if (layout !== this.layoutActive) {
            location = this.layoutLocation[layout]
          }
        },
        'layout.rtl': function(rtl) {
          document.querySelector('html').setAttribute('dir', rtl ? 'rtl' : 'ltr')

          document.querySelectorAll('.mdk-drawer')
            .forEach(node => this.try(node, function() {
              this.mdkDrawer._resetPosition()
            }))

          document.querySelectorAll('.mdk-drawer-layout')
            .forEach(node => this.try(node, function() {
              this.mdkDrawerLayout._resetLayout()
            }))
        },
        'mainDrawer.align': function(align) {
          this.try(document.querySelector('#default-drawer'), function() {
            this.mdkDrawer.align = align
          })
        },
        'mainDrawer.sidebar': {
          'light': {
            '#default-drawer .sidebar': {
              addClass: ['sidebar-light'],
              removeClass: ['sidebar-dark', 'bg-dark', 'sidebar-transparent-sm-up']
            }
          },
          'transparent': {
            '#default-drawer .sidebar': {
              addClass: ['sidebar-light', 'sidebar-transparent-sm-up'],
              removeClass: ['sidebar-dark', 'bg-dark', 'bg-white']
            },
            '#default-drawer .sm-active-button-bg': {
              addClass: ['js-sm-active-button-bg'],
              removeClass: ['sm-active-button-bg']
            },
          },
          'dark': {
            '#default-drawer .sidebar': {
              addClass: ['sidebar-dark', 'bg-dark'],
              removeClass: ['sidebar-light', 'bg-white', 'sidebar-transparent-sm-up']
            },
            '#default-drawer .js-sm-active-button-bg': {
              addClass: ['sm-active-button-bg'],
              removeClass: ['js-sm-active-button-bg']
            },
          }
        },
        'mainNavbar.navbar': {
          'light': {
            '#default-navbar .navbar-brand img': {
              src: 'assets/images/logo/primary.svg',
            },
            '#default-navbar': {
              addClass: ['navbar-light', 'bg-white', 'border-bottom'],
              removeClass: ['navbar-dark', 'bg-primary', 'bg-dark']
            }
          },
          'dark': {
            '#default-navbar .navbar-brand img': {
              src: 'assets/images/logo/white.svg',
            },
            '#default-navbar': {
              addClass: ['navbar-dark', 'bg-dark'],
              removeClass: ['navbar-light', 'bg-primary', 'bg-white', 'border-bottom']
            }
          },
          'primary': {
            '#default-navbar .navbar-brand img': {
              src: 'assets/images/logo/white.svg',
            },
            '#default-navbar': {
              addClass: ['navbar-dark', 'bg-primary'],
              removeClass: ['navbar-light', 'bg-dark', 'bg-white', 'border-bottom']
            }
          }
        }
      }
    }
  },
  computed: {
    computedOptions() {
      const options = JSON.parse(JSON.stringify(this.options))
      options.map(option => {
        option.children
          .filter(group => group.cookies === false)
          .map(group => {
            if (this.layoutActive) {
              group.options.map(go => go.selected = go.value === this.layoutActive)
            } else {
              group.options.map(go => go.selected = go.value === group.value)
            }
          })
      })

      return options
    },
    localDrawerAlign() {
      let drawerAlign = this.drawerAlign
      try {
        drawerAlign = this.settings['mainDrawer.align'] === 'end' ? 'start' : 'end'
      } catch(e) {}

      return drawerAlign
    },
    localButtonAlign() {
      let buttonAlign = this.buttonAlign
      
      try {
        buttonAlign = this.settings['mainDrawer.align'] === 'end' ? 'left' : 'right'
        if (this.settings['layout.rtl']) {
          buttonAlign = this.settings['mainDrawer.align'] === 'end' ? 'right' : 'left'
        }
      } catch(e) {}

      return buttonAlign
    }
  },
  created() {
    this.listenOnRoot('fm:settings:state', this.onUpdate)
  },
  methods: {
    try(node, callback) {
      try {
        callback.call(node)
      } catch(e) {
        node.addEventListener('domfactory-component-upgraded', callback)
      }
    }
  }
}
