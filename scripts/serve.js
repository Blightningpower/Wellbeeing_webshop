import { createServer } from 'node:http';
import { readFile, realpath } from 'node:fs/promises';
import { extname, resolve, sep } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const projectRoot = fileURLToPath(new URL('../', import.meta.url));
const contentTypes = {
  '.html': 'text/html; charset=utf-8',
  '.js': 'text/javascript; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.ico': 'image/x-icon',
};

export function createDevelopmentServer() {
  return createServer(async (request, response) => {
    if (!['GET', 'HEAD'].includes(request.method)) {
      response.writeHead(405, { Allow: 'GET, HEAD' }).end();
      return;
    }
    try {
      const pathname = decodeURIComponent(new URL(request.url, 'http://localhost').pathname);
      const relativePath = pathname === '/' ? 'index.html' : pathname.slice(1);
      const isPublicFile =
        relativePath === 'index.html' || /^(assets|src|html)\//.test(relativePath);
      const segments = relativePath.split(/[\\/]/);
      if (!isPublicFile || segments.some((segment) => segment.startsWith('.'))) {
        response.writeHead(404).end('Niet gevonden');
        return;
      }
      const filename = await realpath(resolve(projectRoot, relativePath));
      if (!filename.startsWith(resolve(projectRoot) + sep)) {
        response.writeHead(404).end('Niet gevonden');
        return;
      }
      const contentType = contentTypes[extname(filename)];
      if (!contentType) {
        response.writeHead(404).end('Niet gevonden');
        return;
      }
      const content = await readFile(filename);
      response.writeHead(200, { 'Content-Type': contentType, 'Cache-Control': 'no-store' });
      response.end(request.method === 'HEAD' ? undefined : content);
    } catch {
      response.writeHead(404).end('Niet gevonden');
    }
  });
}

if (process.argv[1] && import.meta.url === pathToFileURL(resolve(process.argv[1])).href) {
  const port = Number(process.env.PORT || 5500);
  const server = createDevelopmentServer();
  server.on('error', (error) => {
    console.error(`De ontwikkelserver kon niet starten: ${error.message}`);
    process.exitCode = 1;
  });
  server.listen(port, '127.0.0.1', () => console.log(`Wellbeeing: http://127.0.0.1:${port}`));
}
