import { GrpcWebFetchTransport } from "@protobuf-ts/grpcweb-transport";
import { EchoClient } from "./generated/service.client";

const apiUrl = "localhost:8080";

const transport = new GrpcWebFetchTransport({
  baseUrl: apiUrl,
});

export const echoClient = new EchoClient(transport);
