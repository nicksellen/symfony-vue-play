const path = require('path')
const OfflinePlugin = require('offline-plugin')

const backend = 'http://localhost:8000';

const entryConf = {
  client: [], // gets upset if you don't include this
};

const proxyConf = {
  '/api': backend + '/api',
};

// each page has a backend path (should return full html page), and a js file to
// run when it loads
const pages = [
  // see https://vbuild.js.org/#/?id=proxy-api-request
  { name: 'home', path: '/', entry: 'src/home.js' },
  { name: 'otherPage', path: '/other-page', entry: 'src/other-page.js' },
];

pages.forEach(page => {
  proxyConf[page.path] = backend + page.path;
  entryConf[page.name] = [require.resolve('vbuild/lib/dev-client.es6'), page.entry];
});

module.exports = options => ({
  entry: entryConf,
  filename: {
    // just output simple names, not magic hash ones
    js: '[name].js',
    css: '[name].css',
    static: '[name].[ext]'
  },
  postcss: [
    // add more postcss plugins here
    // by default we have autoprefixer pre added
  ],
  html: false,
  webpack(config) {
    console.log('webpack!', config.entry);
    require('fs').writeFileSync('/tmp/wp.json', JSON.stringify(config, null, 2));
    return config
  },
  proxy: proxyConf,
})
